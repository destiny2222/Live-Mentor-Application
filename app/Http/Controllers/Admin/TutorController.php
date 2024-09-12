<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TutorController extends Controller
{
    public function index(){
        try{
            $users = User::orderBy('id', 'asc')->get();
            foreach ($users as $key => $user) {
                $tutor = Tutor::where('user_id', $user->id)->get();
            }
            return view('admin..user.tutor.index', compact('tutor'));
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }


    public function edit ($id){
        try{
            $tutor = Tutor::find($id);
            return view('admin.user.tutor.edit', compact('tutor'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Error occur while editing tutor');
        }
    }


    public function update(Request $request, $id){
        // dd($request->all());
        try{
            $tutor = Tutor::find($id);
            $tutor->update($request->all());
            return redirect()->route('admin.tutor.index')->with('success', 'Tutor updated successfully');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }

    }

    public function destroy($id){
        try{
            $tutor = Tutor::find($id);
            $tutor->delete();
            return redirect()->route('admin.tutor.index')->with('success', 'Tutor deleted successfully');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Tutor not deleted');
        }
    }


}
