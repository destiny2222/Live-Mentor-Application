<?php

namespace App\Http\Controllers\User;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function addBank(Request $request){
        $request->validate([
            'bank_name' => 'nullable|string',
            'bank_account_number' => 'nullable|string',
            'bank_account_name' => 'nullable|string',
        ]);
        
        // if record exist update else create
        try{
            $bank = Bank::where('user_id', Auth::user()->id)->first();
            if($bank){
                $bank->update([
                    'bank_name' => $request->bank_name,
                    'bank_account_number' => $request->bank_account_number,
                    'bank_account_name' => $request->bank_account_name,
                    'user_id' => Auth::user()->id,
                ]);
            }else{
                Bank::create([
                    'bank_name' => $request->bank_name,
                    'bank_account_number' => $request->bank_account_number,
                    'bank_account_name' => $request->bank_account_name,
                    'user_id' => Auth::user()->id,
                ]);
            }
            return redirect()->back()->with('success', 'Bank added successfully');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later');
        }
    }
}
