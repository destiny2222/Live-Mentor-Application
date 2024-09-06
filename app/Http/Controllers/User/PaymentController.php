<?php

namespace App\Http\Controllers\User;

use Paystack;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Proposal;
use App\Models\BookSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function redirectToGateway(Request $request){
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


    public function WebhookGatewayCallback(Request $request)
    {
        try {
            // Check that it's a POST request and contains the Paystack signature
            if ($request->isMethod('POST') && $request->header('X-Paystack-Signature')) {
                
                // Get raw request body
                $input = file_get_contents("php://input");
                define('PAYSTACK_SECRET_KEY', config('services.paystack.SECRET_KEY'));

                // Verify signature
                $calculatedSignature = hash_hmac('sha512', $input, PAYSTACK_SECRET_KEY);
                if ($request->header('X-Paystack-Signature') !== $calculatedSignature) {
                    return back()->with('error', 'Invalid signature.');
                }

                // Decode the Paystack event
                $event = json_decode($input, true);

                if ($event['event'] === 'charge.success') {
                    
                    // Handle proposals
                    if ($event['data']['metadata']['type'] == 'proposal') {
                        $proposal = Proposal::find($event['data']['metadata']['order_id']);
                        if ($proposal) {
                            $proposal->update(['status' => 4]);

                            // Save the payment information
                            $this->savePayment($event);
                            
                            return redirect()->route('dashboard')->with(['success' => 'Payment was successful. You can now access the course', 'type' => 'success']);
                        }
                    } 
                    // Handle sessions
                    elseif ($event['data']['metadata']['type'] === 'session') {
                        $session = BookSession::find($event['data']['metadata']['order_id']);
                        if ($session) {
                            $session->update(['status' => 4, 'book_session_payment_status' => 1]);

                            // Save the payment information
                            $this->savePayment($event);

                            return redirect()->route('dashboard')->with(['success' => 'Payment was successful. You can now access the course', 'type' => 'success']);
                        }
                    } 
                    // Invalid type
                    else {
                        return redirect()->route('dashboard')->with(['error' => 'Payment failed. Please try again.', 'type' => 'error']);
                    }
                } else {
                    // Event is not 'charge.success'
                    return redirect()->route('dashboard')->with(['error' => 'Payment failed. Please try again.', 'type' => 'error']);
                }
            } else {
                return back()->with('error', 'Invalid request method or missing signature.');
            }
        } catch (\Exception $exception) {
            Log::error('Payment callback error: ' . $exception->getMessage());
            return back()->with(['error' => 'The Paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
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


    // public function handleGatewayCallback()
    // {
    //     $paymentDetails = Paystack::getPaymentData();
    //     // dd($paymentDetails);
        
    //     try {
    //         if ($paymentDetails['status'] === true) {
    //             if ($paymentDetails['data']['metadata']['type'] === 'Course') {
    //                 $proposal = Proposal::find($paymentDetails['data']['metadata']['order_id']);
    //                 $proposal->update(['status' => 4]);
    //                 return redirect()->route('dashboard')->with(['success' => 'Payment was successful. You can now access the course', 'type' => 'success']);
    //             } elseif ($paymentDetails['data']['metadata']['type'] === 'Session') {
    //                 $session = BookSession::find($paymentDetails['data']['metadata']['order_id']);
    //                 $session->update(['status' => 4, 'book_session_payment_status'=> 1]);
    //                 return redirect()->route('dashboard')->with(['success' => 'Payment was successful. You can now access the course', 'type' => 'success']);
    //             } else {
    //                 return redirect()->route('dashboard')->with(['error' => 'Payment failed. Please try again.', 'type' => 'error']);
    //             }
                
                
    //         } else {
    //             return redirect()->route('dashboard')->with(['error' => 'Payment failed. Please try again.', 'type' => 'error']);
    //         }
    //     } catch (\Exception $exception) {
    //         Log::error('Payment callback error: ' . $exception->getMessage());
    //         return back()->with(['error' => 'The Paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
    //     }
    // }

}
