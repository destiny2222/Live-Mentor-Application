<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Paystack;

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
                    'course_id'=>$request->input('course_id')
                ],
                'customer' => [
                    'first_name' => $request->input('name'),
                ],
            ];
           return Paystack::getAuthorizationUrl($paymentData)->redirectNow();
        }catch(\Exception $e) {
            Log::error($e->getMessage());
            return Redirect::back()->withMessage(['error'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        } 
    }


    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        dd($paymentDetails);
    }
}
