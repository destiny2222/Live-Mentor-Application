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
                'category_id'=>$mentor->category_id,
                'language'=>$mentor->language,
                'about'=>$mentor->about,
                'price'=>$mentor->price,
                // 'image_public_id'=>$mentor->image_public_id,
                'experience'=>$mentor->experience,
                'status'=> $request->has('status') ? $request->status : $mentor->status,
                'Skills'=>$mentor->Skills,
                'title'=>$mentor->title,
                'user_id'=>$mentor->user_id,
            ]);
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
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went worry');
        }
    }
}
