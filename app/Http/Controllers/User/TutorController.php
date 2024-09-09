<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Tutor;
use App\Models\Awards;
use App\Models\Category;
use App\Models\Proposal;
use App\Models\Education;
use App\Livewire\Syllabus;
use App\Models\Experience;
use Illuminate\Http\Request;
use App\Mail\RequestAccepted;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TutorController extends Controller
{
    public function tutorClass(){
        try{
            $sessions = Proposal::where('user_id', Auth::user()->id)->get();
            return view('user.tutor.tutor-class', compact('sessions'));
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Oops something wrong');
        }
    }


    public function  getTutorProposal(){
        try{
            $user = Auth::user();
            $proposal = Proposal::where('tutor_id', $user->id)->get();                                                                                                                                    
            // dd($proposal);
            return view('user.tutor.pro', compact('proposal'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }

    public function viewProposal($id){
        try{
            $proposal = Proposal::find($id);
            $user = User::where('id', Auth::user()->id)->first();
            // dd($user);
            return view('user.tutor.viewProposal', compact('proposal'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }

    
    public function cancelTutorRequest(Request $request)
    {
        try{
            $proposal = Proposal::find($request->id);
            if (!$proposal || $proposal->tutor_id != Auth::user()->tutor->user_id) {
                return back()->with('error', 'Request not found or you are not authorized to cancel this request.');
            }
            $proposal->update([
                'status' => 2,
                'message'=>$request->input('message'),
            ]);
            return back()->with('success', 'Request cancelled successfully!');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }


    
    public function acceptRequest(Request $request)
    {
        try{
            $proposal = Proposal::find($request->id);

            if ($proposal->tutor_id != Auth::user()->tutor->user_id) {
                return back()->with('error', 'Request not found or you are not authorized to accept this request.');
            }

            $proposal->update([
                'status' => 1,
            ]);
            // Send email notification to the user
            $userTutor = User::where('id', $proposal->tutor_id)->first();
            Mail::to($proposal->user->email)->send(new RequestAccepted($proposal, $userTutor));
            return back()->with('success', 'Request accepted successfully!');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }

    public function deleteRequest($id){
        try{
            $proposal = Proposal::find($id);
            $proposal->delete();
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }


    public function storeTutor(Request $request){
        try{
            $request->validate([
                'language' => ['required', 'string'],
                'title' => ['required', 'string'],
                'resume' => ['required', 'file'], 
            ]);

            // check if the user is a tutor
            if ($request->user()->tutor) {
                return redirect()->back()->with('error', 'You are already a tutor');
            }
            
    
            $uploadedFileUrl = $request->file('resume')->storeOnCloudinary('tutor/resume');
            $url = $uploadedFileUrl->getSecurePath();
            $public_id = $uploadedFileUrl->getPublicId();
    
           $skills = $request->input('skills', []);
            $categories = $request->input('category_id', []); 

            $tutor = new Tutor;
            $tutor->skill = $skills;
            $tutor->language = $request->input('language');
            $tutor->description = $request->input('description');
            $tutor->price = $request->input('price');
            // $tutor->category_id = $categories;
            $tutor->resume = $url;
            $tutor->resume_public_id = $public_id;
            $tutor->title = $request->input('title');
            $tutor->user_id = Auth::user()->id;

            // dd($request->all());
            $tutor->save();
            $tutor->categories()->attach($categories);


            // Save education records
            $education = new Education;
            $education->school = $request->input('school');
            $education->degree = $request->input('degree');
            $education->field_of_study = $request->input('field_of_study');
            $education->start_date = $request->input('start_date');
            $education->end_date = $request->input('end_date');
            $education->description = $request->input('description');
            $education->user_id = Auth::user()->id;
            $education->save();

            // Save award records
            $award = new Awards;
            $award->user_id = Auth::user()->id;
            $award->title = $request->title;
            $award->company = $request->company;
            $award->date = $request->date;
            $award->date_end = $request->date_end;
            $award->description = $request->description;
            $award->save();

            // Save experience records
            $experience = new Experience;
            $experience->user_id = Auth::user()->id;
            $experience->title = $request->title;
            $experience->company = $request->company;
            $experience->start_date = $request->start_date;
            $experience->end_date = $request->end_date;
            $experience->description = $request->description;
            $experience->save();
            
            return redirect(route('syllabus.index'))->with('success', 'Tutor profile created successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'Oops something went wrong!');
        }
    }
    






    public function syllabus(Request $request){
        try{
            $tutor = Tutor::where('user_id', Auth::user()->id)->with('categories')->first();
            $categories = $tutor ? $tutor->categories : [];
            return view('user.tutor.syllabus', compact('categories'));
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
        
    }


    

    public function syllabusStore(Request $request){
        try {
            $tutor = Tutor::where('user_id', Auth::user()->id)->first();

            // Check if the category already exists for the tutor
            $existingSyllabus = Syllabus::where('category_id', $request->category_id)
                ->where('tutor_id', $request->tutor_id)
                ->first();

            if ($existingSyllabus) {
              return back()->with('error', 'This category already exists for the tutor.');
            }

            $syllabus = new syllabus;
            $syllabus->tutor_id = $tutor->id;
            $syllabus->category_id = $request->category_id;
            $syllabus->description = $request->description;
            $tutor->save();
            return back()->with('success', 'Save Successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }

    public function tutor() {
        try{
            $category = Category::all();
            $user = Auth::user();
            $tutor = Tutor::orderBY('id', 'asc')->first();
            // dd($tutor);
            // $count = ;
            return view('user.tutor.create-tutor', compact('category', 'user','tutor'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

}
