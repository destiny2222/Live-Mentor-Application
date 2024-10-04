<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Notifications\TutorApproved;
use App\Notifications\TutorRejected;

class TutorController extends Controller
{
    public function index(){
        try{
            $tutors = Tutor::orderBy('id', 'desc')->get(); 
            return view('admin..user.tutor.index', compact('tutors'));
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
            $tutor->update([
                'category_id'=>$tutor->category_id,
                'language'=>$tutor->language,
                'description'=>$tutor->description,
                // 'image_public_id'=>$tutor->image_public_id,
                'experience'=>$tutor->experience,
                'is_approved'=> $request->has('is_approved') ? $request->is_approved : $tutor->is_approved,
                'skill'=>$tutor->skill,
                'title'=>$tutor->title,
                'user_id'=>$tutor->user_id,
            ]);
             // send notification to user email when is_approved equal to 1
             if($tutor->is_approved == 1){
                $user = User::find($tutor->user_id);
                $user->notify(new TutorApproved($user));
            }elseif($tutor->is_approved == 0){
                $user = User::find($tutor->user_id);
                $user->notify(new TutorRejected($user));
            }
            return redirect()->route('admin.tutor.index')->with('success', 'Tutor updated successfully');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }

    }

    public function delete($id){
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
