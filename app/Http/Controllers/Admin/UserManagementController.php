<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    public function index(){
       try {
            $users = User::orderBy('id', 'desc')->get();
            return view('admin.user.index', compact('users'));
       } catch (\Exception $exception) {
          Log::error($exception->getMessage());
          return back()->with('error', 'Something went wrong');
       }
    }


    public function edit($id){
        try{
            $users = User::find($id);
           return view('admin.user.edit', compact('users'));
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }


    public function update(Request $request, $id){
        $validator = Validator::make([ 
            'name'=>['required','required'],
            'email'=>['required','required', 'email'],
            'role'=>['nullable','required'],
            'phone'=>['required','required'],
            'gender'=>['nullable','required'],
            'city'=>['nullable','required'],
            'country'=>['nullable','required'],
            'language'=>['nullable','required'],
            'username'=>['nullable','required'],
            'image'=>['nullable'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput(); 
        }

        try{
            $users = User::find($id);
            $users->update([ 
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'phone'=>$request->input('phone'),
                'gender'=>$request->input('gender'),
                'city'=>$request->input('city'),
                'country'=>$request->input('country'),
                'language'=>$request->input('language'),
                'username'=>$request->input('username'),
                // 'image'=>,
            ]);
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

    public function delete($id){
       try{
            $users = User::find($id);
            $users->delete();
            return back()->with('success', 'Deleted Successful');
       }catch(\Exception $exception){
           Log::error($exception->getMessage());
           return back()->with('error', ' failed to delete');
       }
    }
}
