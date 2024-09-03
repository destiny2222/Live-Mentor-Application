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


    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        dd($paymentDetails);
        
        try {
            if ($paymentDetails['status'] === true) {
                if ($paymentDetails['data']['metadata']['type'] === 'proposal') {
                    $proposal = Proposal::find($paymentDetails['data']['metadata']['order_id']);
                    $proposal->update(['status' => 4]);
                    return redirect()->route('dashboard')->with(['success' => 'Payment was successful. You can now access the course', 'type' => 'success']);
                } elseif ($paymentDetails['data']['metadata']['type'] === 'session') {
                    $session = BookSession::find($paymentDetails['data']['metadata']['order_id']);
                    $session->update(['book_session_payment_status' => 1]);
                    return redirect()->route('dashboard')->with(['success' => 'Payment was successful. You can now access the course', 'type' => 'success']);
                } else {
                    return redirect()->route('dashboard')->with(['error' => 'Payment failed. Please try again.', 'type' => 'error']);
                }
                
                $payment = new Payment;
                $payment->user_id = $paymentDetails['data']['metadata']['user_id'];
                $payment->course_id = $paymentDetails['data']['metadata']['order_id'];
                $payment->amount = $paymentDetails['data']['amount'];
                $payment->payment_date = Carbon::now();
                $payment->payment_method = $paymentDetails['data']['channel'];
                $payment->payment_status = 'Paid';
                $payment->save();
            } else {
                return redirect()->route('dashboard')->with(['error' => 'Payment failed. Please try again.', 'type' => 'error']);
            }
        } catch (\Exception $exception) {
            Log::error('Payment callback error: ' . $exception->getMessage());
            return back()->with(['error' => 'The Paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }

}
