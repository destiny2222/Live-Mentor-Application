<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookSession;
use App\Models\Payment;
use App\Models\Proposal;
use App\Models\User;
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
                return redirect()->route('dashboard')->with('status', 'Payment is being processed. You will be notified once it is complete.');
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




}
