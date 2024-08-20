<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\TutorMailRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Proposal;
use App\Models\Review;
use App\Models\syllabus;
use App\Models\Tutor;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user();
        $courses = Course::orderBy('id', 'asc')->get();
        $enrollCourse = Proposal::where('user_id', $user->id)->whereIn('course_id', $courses->pluck('id'))->get();
        $enrolledCourses = Course::whereIn('id', $enrollCourse->pluck('course_id'))->get();
    
        // dd($enrolledCourses);
        return view('auth.dashboard', compact('enrolledCourses', 'user'));
    }
    

    public function tutor() {
        $category = Category::all();
        $user = Auth::user();
        $tutor = Tutor::orderBY('id', 'asc')->first();
        // dd($tutor);
        // $count = ;
        return view('auth.create-tutor', compact('category', 'user','tutor'));
    }
    
    public function storeTutor(Request $request){
        try{
            $request->validate([
                'language' => ['required', 'string'],
                'title' => ['required', 'string'],
                'resume' => ['required', 'file'], 
            ]);
    
            $uploadedFileUrl = $request->file('resume')->storeOnCloudinary('tutor/resume');
            $url = $uploadedFileUrl->getSecurePath();
            $public_id = $uploadedFileUrl->getPublicId();
    
           $skills = $request->input('skill', []);
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


    
            return redirect(route('syllabus.index'))->with('success', 'Save Successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }
    



    public function syllabus(Request $request){
        
        $tutor = Tutor::where('user_id', Auth::user()->id)->with('categories')->first();
        $categories = $tutor ? $tutor->categories : [];
        return view('auth.syllabus', compact('categories'));
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

            // dd($request->all());


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

    public function proposal(){
        $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();    
        return view('auth.proposal', compact('proposal'));
    }
    

    public function proposalStore(Request $request){
        try {
            $course = Course::find($request->id);

            if (!$course) {
                return back()->with('error', 'Course not found');
            }

            // if exists proposal update it
            $proposal = Proposal::where('user_id', Auth::user()->id)->where('course_id', $course->id)->first();

            if ($proposal) {
                $proposal->user_id = Auth::user()->id;
                $proposal->course_id = $course->id;
                $proposal->title = $course->title;
                $proposal->price = $course->price;
                $proposal->save();
            } else {
                $proposal = new Proposal;
                $proposal->user_id = Auth::user()->id;
                $proposal->course_id = $course->id;
                $proposal->title = $course->title;
                $proposal->price = $course->price;
                $proposal->save();
            }

            return redirect(route('proposal.index'))->with('success', 'Proposal saved successfully');

            

            return redirect(route('proposal.index'))->with('success', 'Proposal saved successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }

    public function savePreference(Request $request){

        try{

            
            $days = $request->input('days', []);

            // dd($request->all());
            // if exists proposal update it
            $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();
            if($proposal){
                $proposal->update([
                    'prefer' => $request->prefer,
                    'language' => $request->language,
                    'time' => $request->time,
                    'day' => $days,
                    'tutor_id' => $request->tutor_id,
                    'user_id'=>Auth::user()->id,
                    'course_id'=> $proposal->course_id,
                ]);
            }else{
                // create new proposal
                Proposal::create([
                    'prefer' => $request->prefer,
                    'language' => $request->language,
                    'time' => $request->time,
                    'day' => $days,
                    'tutor_id' => $request->tutor_id,
                    'user_id' => Auth::user()->id,
                    'course_id' => $proposal->course_id,
                ]);
            }

            

            return back()->with('success', 'Your preference has been saved');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }

    public function listTutor()
    {
        $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();

        $course = Course::find($proposal->course_id);
        // dd($course);
        $category = Category::find($course->category_id);
        // dd($category->tutors);
        // Find a tutor associated with this category
        $tutors = $category->tutors;

        return view('auth.tutor', compact('tutors'));
    }

    public function tutorProfile($id){
        $user = User::findOrFail($id);
        $tutor = Tutor::where('user_id', $user->id)->firstOrFail();
        return view('auth.tutor-profile', compact('tutor', 'user'));
    }

    public function  sendTutorRequest(Request $request){
        // if exists proposal update it
        $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();
        $tutor = User::where('id', $request->id)->first();

        if ($proposal) {
            $proposal->update([ 
                'user_id' => Auth::user()->id,
                'tutor_id' => $tutor->id,
            ]);
        } 
        Mail::to($tutor->email)->send(new TutorMailRequest($proposal));
        return back()->with('success', 'Request sent successfully!');
    }


    public function storeReview(Request $request, $tutor_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review = new Review;
        $review->tutor_id = $tutor_id;
        $review->user_id = Auth::user()->id;
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->name = $request->input('name');
        $review->email = $request->input('email');
        $review->save();

        return back()->with('success', 'Thank you for your review!');
    }

    
}
