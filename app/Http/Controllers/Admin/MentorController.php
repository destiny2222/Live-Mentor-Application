<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\User;
use App\Notifications\MentorApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MentorController extends Controller
{
    public function index(){
        $mentors = Mentor::orderBy('id', 'desc')->get();
        return view('admin.user.mentor.index', compact('mentors'));
    }

    public function edit($id){
        try{
            $mentor = Mentor::findOrFail($id);
            return view('admin.user.mentor.edit', compact('mentor'));
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

    public function update(Request $request, $id){
        try{
            $mentor = Mentor::findOrFail($id);
            $mentor->update([
                'language'=>$mentor->language,
                'about'=>$mentor->about,
                'price'=>$mentor->price,
                // 'image_public_id'=>$mentor->image_public_id,
                'experience'=>$mentor->experience,
                'is_approved'=> $request->has('is_approved') ? $request->is_approved : $mentor->is_approved,
                'Skills'=>$mentor->Skills,
                'title'=>$mentor->title,
                'user_id'=>$mentor->user_id,
            ]);
            // send notification to user email when is_approved equal to 1
            if($mentor->is_approved == 1){
                $user = User::find($mentor->user_id);
                $user->notify(new MentorApproved($user));
            }
            return redirect()->route('admin.mentor.index')->with('success', 'Mentor updated successfully');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

    public function delete($id){
        try{
            $mentor = Mentor::findOrFail($id);
            $mentor->delete();
            return back()->with('error', 'Deleted successfully');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went worry');
        }
    }
}
