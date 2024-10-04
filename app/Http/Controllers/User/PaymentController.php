<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookSession;
use App\Models\GroupSession;
use App\Models\Invitation;
use App\Models\Payment;
use App\Models\Proposal;
use App\Models\User;
use App\Notifications\GroupInvitation;
use App\Notifications\PaymentFailedNotification;
use App\Notifications\PaymentSuccessfulNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Paystack;

class PaymentController extends Controller
{
    public function redirectToGateway(Request $request)
{
    Log::info('redirectToGateway method called', ['request' => $request->all()]);
    
    $request->validate([
        'email' => 'required|email',
        'name' => 'required|string',
        'price' => 'required|numeric',
        'reference' => 'required|string',
    ]);
    
    try {
        $paymentData = [
            'email' => $request->input('email'),
            'first_name' => $request->input('name'),
            'amount' => $request->input('price') * 100,
            'reference' => $request->input('reference'),
            'currency' => 'NGN',
            'callback_url' => route('callback.payment'),
            'metadata' => [
                'order_id' => $request->input('id'),
                'user_id' => Auth::user()->id,
                'course_id'=>$request->input('course_id'),
                'type'=>$request->input('type'),
            ],
            'customer' => [
                'first_name' => $request->input('name'),
            ],
        ];
        // $paymentData['webhook_url'] = route('paystack.webhook');
        
        Log::info('Payment data prepared', ['paymentData' => $paymentData]);
        
        $authorizationUrl = Paystack::getAuthorizationUrl($paymentData)->url;
        Log::info('Authorization URL generated', ['url' => $authorizationUrl]);
        
        return redirect($authorizationUrl);
    } catch(\Exception $e) {
        Log::error('Error in redirectToGateway', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'paystack_error' => method_exists($e, 'getResponseBody') ? $e->getResponseBody() : null
        ]);
        return redirect()->back()->withMessage(['error'=>'Unable to initiate payment. Please try again later.', 'type'=>'error']);
    } 
}

    public function handleGatewayCallback()
    {
        Log::info('handleGatewayCallback method called');
        
        try {
            $paymentDetails = Paystack::getPaymentData();
            // dd($paymentDetails);
            
            Log::info('Payment details retrieved', ['details' => $paymentDetails]);
            
            if ($paymentDetails['status'] === true) {
                Log::info('Payment successful, redirecting to history page');
                $metadata = $paymentDetails['data']['metadata'];
                $user = User::find($metadata['user_id']);

                if ($metadata['type'] === 'proposal') {
                    $this->handleProposalPayment($metadata, $user);
                } elseif ($metadata['type'] === 'session') {
                    $this->handleSessionPayment($metadata, $user);
                } else {
                    Log::warning('Unknown payment type', ['type' => $metadata['type']]);
                    return response()->json(['error' => 'Unknown payment type'], 400);
                }
                $this->savePayment($paymentDetails);
                return redirect()->route('show.history')->with('success', 'Payment is being processed. You will be notified once it is complete.');
            } else {
                Log::warning('Payment failed', ['details' => $paymentDetails]);
                return redirect()->route('show.history')->with(['error' => 'Payment failed. Please try again.', 'type' => 'error']);
            }
        } catch (\Exception $exception) {
            Log::error('Payment callback error', ['message' => $exception->getMessage(), 'trace' => $exception->getTraceAsString()]);
            return back()->with(['error' => 'The Paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }
    
    protected function handleProposalPayment($metadata, $user)
    {
        $proposal = Proposal::find($metadata['order_id']);
        Log::info('Updating proposal', ['before' => $proposal->toArray()]);
        $proposal->update(['status' => 4]);
        Log::info('Proposal updated', ['after' => $proposal->fresh()->toArray()]);
        $user->notify(new PaymentSuccessfulNotification($proposal));
    }
    

    
    protected function savePayment($paymentDetails)
    {
        $payment = Payment::create([
            'user_id' => $paymentDetails['data']['metadata']['user_id'],
            'course_id' => $paymentDetails['data']['metadata']['order_id'],
            'amount' => $paymentDetails['data']['amount'],
            'payment_date' => now(),
            'payment_method' => $paymentDetails['data']['channel'],
            'payment_status' => 'Paid',
        ]);
        Log::info('Payment saved', ['payment' => $payment->toArray()]);
    }

    protected function handleSessionPayment($metadata, $user)
    {
        $session = BookSession::find($metadata['order_id']);
        Log::info('Updating session', ['before' => $session->toArray()]);
        $session->update(['status' => 4, 'book_session_payment_status' => 1]);
        Log::info('Session updated', ['after' => $session->fresh()->toArray()]);
        $user->notify(new PaymentSuccessfulNotification($session));
    }

    public function initiatePayment(Request $request)
        {
            $groupSession = GroupSession::findOrFail($request->group_session_id);
    
            try {
                
                $paymentData = [
                    'amount' => $groupSession->price * 100,
                    'email' => Auth::user()->email,
                    'reference' =>  Paystack::genTranxRef(),
                    'callback_url' => route('payment.callback'),
                    'metadata' => [
                        'group_session_id' => $groupSession->id,
                        'user_id' => Auth::user()->id,
                    ]
                ];
               
                $invitation = new Invitation();
                $invitation->user_id = Auth::user()->id;
                $invitation->group_session_id = $groupSession->id;
                $invitation->amount = $groupSession->price;
                $invitation->invitation_count = $groupSession->invitation_token;
                $invitation->email = Auth::user()->email;
                $invitation->invitation_code = $groupSession->zoom_meeting_link;
                $invitation->reference =  $paymentData['reference'];
                $invitation->payment_status = false;
                $invitation->is_invited = false;
                $invitation->save();
    
                return Paystack::getAuthorizationUrl($paymentData)->redirectNow();
            } catch (\Exception $e) {
                Log::error('Payment initiation failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Unable to initiate payment. Please try again later.');
            }
        }
    
        public function handlePaymentCallback()
        {
            try {
                $paymentDetails = Paystack::getPaymentData();
                // dd($paymentDetails);
                // $invitation = Invitation::where('reference', $paymentDetails['data']['reference'])->firstOrFail();
                $invite = Invitation::where('reference', $paymentDetails['data']['reference'])->first();
                // dd($invitation);
    
                if ($paymentDetails['data']['status'] === 'success') {
                    $invite->update([
                        'payment_status' => true,
                        'is_invited' => true,
                    ]);
                    $invite->user->notify(new GroupInvitation($invite));
                    return redirect()->route('group.session', $invite->invitation_count)
                        ->with('success', 'Payment successful. You are now RSVP\'d for the session.');
                } else {
                    $invite->update([
                        'payment_status' => false,
                        'is_invited' => false,
                    ]);
    
                    return redirect()->route('group.session', $invite->invitation_count)
                        ->with('error', 'Payment failed. Please try again.');
                }
            } catch (\Exception $e) {
                Log::error('Payment callback handling failed: ' . $e->getMessage());
                return back()->with('error', 'An error occurred while processing your payment. Please contact support.');
            }
        }
    
        public function handleWebhook(Request $request)
        {
            $payload = json_decode($request->getContent());
    
            if (!$this->verifyWebhook($request)) {
                Log::warning('Invalid webhook signature received');
                return response()->json(['status' => 'invalid signature'], 400);
            }
    
            switch($payload->event) {
                case 'charge.success':
                    return $this->handleSuccessfulPayment($payload->data);
                default:
                    Log::info('Unhandled webhook event: ' . $payload->event);
                    return response()->json(['status' => 'not handled'], 200);
            }
        }
    
        private function verifyWebhook(Request $request)
        {
            $paystackSignature = $request->header('x-paystack-signature');
            $computedSignature = hash_hmac('sha512', $request->getContent(), config('services.paystack.SECRET_KEY'));
            
            return hash_equals($paystackSignature, $computedSignature);
        }
    
        private function handleSuccessfulPayment($data)
        {
            try {
                $invite = Invitation::where('reference', $data->reference)->firstOrFail();
    
                $invite->update([
                    'payment_status' => true,
                    'is_invited' => true,
                ]);
    
                // You might want to send a confirmation email here
                // event(new PaymentSuccessful($invitation));
                $invite->user->notify(new GroupInvitation($invite));
                // return redirect()->back()->with('success', 'You have successfully join RSVP.');
                return response()->json(['status' => 'successful'], 200);
            } catch (\Exception $e) {
                Log::error('Failed to handle successful payment: ' . $e->getMessage());
                return response()->json(['status' => 'processing failed'], 500);
            }
        }
    

}
