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
    public function redirectToGateway(Request $request){
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'reference' => 'required|string',
        ]);
        try{
            
            $paymentData = [
                'email' => $request->input('email'),
                'first_name' => $request->input('name'),
                'amount' => $request->input('price') * 100,
                'reference' => $request->input('reference'),
                'currency' => 'NGN',
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
           return Paystack::getAuthorizationUrl($paymentData)->redirectNow();
        }catch(\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withMessage(['error'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        } 
    }

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        
        try {
            if ($paymentDetails['status'] === true) {
                return redirect()->route('dashboard')->with('success', 'Payment is being processed. You will be notified once it is complete.');
            } else {
                return redirect()->route('dashboard')->with(['error' => 'Payment failed. Please try again.', 'type' => 'error']);
            }
        } catch (\Exception $exception) {
            Log::error('Payment callback error: ' . $exception->getMessage());
            return back()->with(['error' => 'The Paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }

    public function WebhookGatewayCallback(Request $request)
    {
        try {
            if ($request->isMethod('POST') && $request->header('HTTP_X_PAYSTACK_SIGNATURE')) {
                $input = @file_get_contents("php://input");
                $secretKey = config('services.paystack.secret');

                if ($request->header('HTTP_X_PAYSTACK_SIGNATURE') === hash_hmac('sha512', $input, $secretKey)) {
                    $event = json_decode($input, true);

                    $metadata = $event['data']['metadata'];
                    $user = User::find($metadata['user_id']);
                    if ($event['event'] === 'charge.success') {

                        if ($metadata['type'] === 'proposal') {
                            $proposal = Proposal::find($metadata['order_id']);
                            $proposal->update(['status' => 4]);
                            // Notify the user
                            $user->notify(new PaymentSuccessfulNotification($proposal));
                        } elseif ($metadata['type'] === 'session') {
                            $session = BookSession::find($metadata['order_id']);
                            $session->update(['status' => 4, 'book_session_payment_status' => 1]);
                            // Notify the user
                            $user->notify(new PaymentSuccessfulNotification($session));
                        }
                        $this->savePayment($event);
                        return response()->json(['status' => 'success'], 200);
                    } else {
                        $user->notify(new PaymentFailedNotification('The payment could not be processed.'));
                        return response()->json(['error' => 'Payment failed'], 400);
                    }
                } else {
                    return response()->json(['error' => 'Invalid signature'], 400);
                }
            }

            return response()->json(['error' => 'Invalid request'], 400);
        } catch (\Exception $exception) {
            Log::error('Payment callback error: ' . $exception->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }


    // Helper function to save payment details
    protected function savePayment($event)
    {
        $payment = new Payment;
        $payment->user_id = $event['data']['metadata']['user_id'];
        $payment->course_id = $event['data']['metadata']['order_id'];
        $payment->amount = $event['data']['amount'];
        $payment->payment_date = Carbon::now();
        $payment->payment_method = $event['data']['channel'];
        $payment->payment_status = 'Paid';
        $payment->save();
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
                $invitation = Invitation::where('reference', $paymentDetails['data']['reference'])->first();
                // dd($invitation);
    
                if ($paymentDetails['data']['status'] === 'success') {
                    $invitation->update([
                        'payment_status' => true,
                        'is_invited' => true,
                    ]);
                    
                    return redirect()->route('group.session', $invitation->invitation_count)
                        ->with('success', 'Payment successful. You are now RSVP\'d for the session.');
                } else {
                    $invitation->update([
                        'payment_status' => false,
                        'is_invited' => false,
                    ]);
    
                    return redirect()->route('group.session', $invitation->invitation_count)
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
