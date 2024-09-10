<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MentorController extends Controller
{
    public function index(){
        $users = User::orderBy('id', 'desc')->get();
        foreach($users as $user){
            $mentor = Mentor::where('user_id', $user->id)->get();
        }
        return view('admin.mentor.index', compact('mentor'));
    }

    public function edit($id){
        try{
            $mentor = Mentor::findOrFail($id);
            return view('admin.mentor.edit', compact('mentor'));
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

    public function update(Request $request, $id){
        try{
            $mentor = Mentor::findOrFail($id);
            $mentor->update($request->all());
            return redirect()->route('admin.mentor.index')->with('success', 'Mentor updated successfully');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

    public function destory($id){
        try{
            $mentor = Mentor::findOrFail($id);
            $mentor->delete();
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went worry');
        }
    }
}
