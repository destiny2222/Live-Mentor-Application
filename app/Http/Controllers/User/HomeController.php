<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Award;
use App\Models\Tutor;
use App\Models\Awards;
use App\Models\Course;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Proposal;
use App\Models\syllabus;
use App\Models\Education; 
use App\Models\Experience;
use Illuminate\Http\Request;
use App\Mail\RequestAccepted;
use App\Mail\TutorMailRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\RequestNotification;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class HomeController extends Controller
{
    public function index() {
        try{
            $user = Auth::user();
            $proposals = Proposal::where('user_id', $user->id)->where('status', '3')->get();
            $enrolledCourses = [];
        
            foreach ($proposals as $pro) {
                $course = Course::find($pro->course_id);
                if ($course) {
                    // Add the course and its corresponding proposal to the array
                    $enrolledCourses[] = [
                        'course' => $course,
                        'proposal' => $pro
                    ];
                }
            }
        
            return view('auth.dashboard', compact('enrolledCourses', 'user'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return Redirect::back()->with('error', 'Something went wrong, please try again later.');
        }
    }
    
    
    

    public function tutor() {
        try{
            $category = Category::all();
            $user = Auth::user();
            $tutor = Tutor::orderBY('id', 'asc')->first();
            // dd($tutor);
            // $count = ;
            return view('auth.create-tutor', compact('category', 'user','tutor'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong. Please try again later.');
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
            return view('auth.syllabus', compact('categories'));
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

    public function proposal(){
        try {
            // Get the latest proposal for the authenticated user
            $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();    
            return view('auth.proposal', compact('proposal'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
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
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }

    public function savePreference(Request $request){
        try{

            
            $days = $request->input('days', []);

    
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

            if ($request->has('save_find')) {
                return redirect(route('preference.listTutor'))->with('success', 'Your preference has been saved!');
            } elseif ($request->has('save_request')) {
                $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();
                if (!$proposal) {
                    return back()->with('error', 'No proposal found for the current user.');
                }
    
                $course = Course::find($proposal->course_id);
                if (!$course) {
                    return back()->with('error', 'No course found for the given proposal.');
                }
    
                $category = Category::find($course->category_id);
                if (!$category) {
                    return back()->with('error', 'No category found for the given course.');
                }
    
                $tutors = $category->tutors;
                if ($tutors->isEmpty()) {
                    return back()->with('error', 'No tutor found for the given proposal.');
                }
    
                $user = User::find(Auth::user()->id);
                if (!$user) {
                    return back()->with('error', 'No user found for the given proposal.');
                }
    
                foreach ($tutors as $tutor) {
                    // update the proposal
                    $proposal->update([
                        'tutor_id' => $tutor->user->id, 
                        'status' => 3,
                    ]);
                    // send notification to the tutor's user
                    if ($tutor->user) {
                        $tutor->user->notify(new RequestNotification($user, $course));
                    }
                }
    
                return back()->with('success', 'Your request has been sent!');
            } else {
                return back()->with('error', 'Something went wrong!');
            } 
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }


    // public 

    public function listTutor()
    {
        try{
            $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();
            $course = Course::find($proposal->course_id);
            $category = Category::find($course->category_id);
            // Find a tutor associated with this category
            $tutors = $category->tutors;
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Oops something went wrong');
        }
        return view('auth.tutor', compact('tutors'));
    }

    public function tutorProfile($id){
        try{
            $user = User::findOrFail($id);
            $tutor = Tutor::where('user_id', $user->id)->firstOrFail();
            $educations = Education::where('user_id', $tutor->user->id)->get();
            $experiences = Experience::where('user_id',  $tutor->user->id)->get();
            $certifications = Awards::where('user_id',  $tutor->user->id)->get();
            return view('auth.tutor-profile', compact('tutor', 'user', 'educations', 'certifications', 'experiences'));
        }catch(\Exception $exception) {
            log::error($exception->getMessage());
            return redirect()->back()->with('error', 'Tutor not found');
        }
    }



    public function sendTutorRequest(Request $request) {
        

        try{
            // Get the latest proposal for the authenticated user
            $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();
            $tutor = User::find($request->id);
        
            if (!$tutor) {
                return back()->with('error', 'Tutor not found.');
            }
        
            if ($proposal) {
                $proposal->update([
                    'tutor_id' => $tutor->id,
                    'status'=> 3,
                ]);
            } else {
                $proposal = Proposal::create([
                    'user_id' => Auth::user()->id,
                    'tutor_id' => $tutor->id,
                    'status'=> 3,
                ]);
            }
        
            // Eager load relationships
            Session(['tutorName'=> $request->tutor_name]);
        
            Mail::to($tutor->email)->send(new TutorMailRequest($proposal));
        
            return back()->with('success', 'Request sent successfully!');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
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


    public function profile(){
        $profile = Auth::user();
        return view('auth.profile', compact('profile'));
    }



    public function updateProfile(Request $request, $id)
    {
        

        // Validate the request
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            // Other validation rules...
        ]);

        try{
            
            
            // dd($request->all());
            if($request->hasFile('image')) {
                $image_file = time().'.'.$request->image->extension();
                $request->image->move(public_path('profile'),$image_file);
            }
            
            // Update other profile fields
            $profile = User::findOrFail($id);
            $profile->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'city' => $request->city,
                'gender'=>$request->gender,
                'country'=>$request->country,
                'role'=>$profile->role,
                'image' => $image_file ?? $profile->image,
                // Other profile fields...
            ]);

            $profile->save();
            return redirect()->back()->with('success', 'Profile updated successfully.');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }



    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        try {
            $user = User::find(Auth::user()->id);

            // Check if the current password matches
            if (Hash::check($request->current_password, $user->password)) {
                // check of confirm password is same as new password
                if ($request->new_password == $request->confirm_password) {
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return back()->with('success', 'Password changed successfully!');
                }else{
                    return back()->with('error', 'New password and confirm password do not match.');
                }
                
            } else {
                return back()->with('error', 'Current password is incorrect.');
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }


    public function destroyUser(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);
    
        $user = $request->user();
    
        Auth::logout();
    
        $user->delete();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return Redirect::to('/');
    }
    


    public function EnrollCourse() {
        try {
            $user = Auth::user();
            
            // Paginate proposals with a status of 3
            $proposals = Proposal::where('user_id', $user->id)->where('status', '3')->paginate(10); 
            $enrolledCourses = [];
        
            foreach ($proposals as $pro) {
                $course = Course::find($pro->course_id);
                
                // Check if the user has already made a payment for this course
                $payment = Payment::where('user_id', $user->id)->where('course_id', $pro->course_id)->where('payment_status', 1)->first();
                                  
                if ($course && !$payment) {
                    $enrolledCourses[] = $course;
                }
            }
            
            return view('auth.course', compact('enrolledCourses', 'user', 'proposals'));
        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'Oops something went wrong');
        }
    }
    
    
    

    public function  getTutorProposal(){
        try{
            $user = Auth::user();
            $proposal = Proposal::where('tutor_id', $user->id)->get();                                                                                                                                    
            // dd($proposal);
            return view('auth.pro', compact('proposal'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
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

    public function cancelTutorRequest(Request $request)
    {
        try{
            $proposal = Proposal::find($request->id);
            if (!$proposal || $proposal->tutor_id != Auth::user()->tutor->user_id) {
                return back()->with('error', 'Request not found or you are not authorized to cancel this request.');
            }
            $proposal->update([
                'status' => 2,
            ]);
            return back()->with('success', 'Request cancelled successfully!');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }


    public function paymentHistory($id)
    {
        try{
            $history = Proposal::find($id);
            if (!$history) {
                return back()->with('error', 'Record not found.');
            }
            return view('auth.history', compact('history'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }

    public function History(){
        try{
            $history = Proposal::where('status', '1')->get();
            // dd($history);
            return view('auth.history', compact('history'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
       
    }

    public function Classes(){
        try{
            $proposalDetails = Proposal::where('status', '1')->get();
            return view('auth.show-proposal', compact('proposalDetails'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }




}
