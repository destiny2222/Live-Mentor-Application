<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\MentorAccepted;
use App\Models\BookSession;
use App\Models\Category;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Mentor;
use App\Models\MentorApplication;
use App\Notifications\MentorNotification;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MentorController extends Controller
{
    public function index(){
        $bookings = BookSession::where('mentor_id', Auth::user()->id)->get();
        return view('auth.mentor.index', compact('bookings'));
    }
    
   
    
    public function create(){
        $category = Category::orderBy('id', 'desc')->get();
        return view('auth.mentor.create', compact('category'));
    }
    public function store(Request $request) {
        $rules = [
            'title' => 'required|string',
            // 'skills.*' => 'string',
            'about' => 'required|string',
            // 'experiences.*.title' => 'required|string',
            // 'experiences.*.company' => 'required|string',
            // 'experiences.*.start_date' => 'required|date',
            // 'experiences.*.end_date' => 'nullable|date|after_or_equal:experiences.*.start_date',    
            // 'experiences.*.description' => 'required|string',
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->with('error', $validator);
        }
        // dd($request->all());
        try {
            $education = $request->input('education', []);
            $Skill = $request->input('skills', []);
            
            // if exists 
            $mentor = Mentor::where('user_id', Auth::user()->id)->first();
            if ($mentor) {
                $mentor->update([
                    'about' => $request->about,
                    'title' => $request->title,
                    'Skills' => $Skill,
                    'category_id' => $request->category_id,
                    'user_id' => Auth::user()->id,
                ]);

                // Save multiple experiences
            foreach ($request->input('experiences') as $experience) {

                if (strtotime($experience['start_date']) > strtotime($experience['end_date'])) {
                    return back()->withErrors(['error' => 'Start date cannot be after end date.'])->withInput();
                }


                Experience::create([
                    'user_id' => Auth::user()->id,
                    'title' => $experience['title'],
                    'company' => $experience['company'],
                    'start_date' => date('Y-m-d', strtotime($experience['start_date'])),
                   'end_date' => $experience['end_date'] ? date('Y-m-d', strtotime($experience['end_date'])) : null,
                    'description' => $experience['description'],
                ]);
            }


            
            // Save education records
            foreach ($request->education as $educationData) {
                $education = new Education;
                $education->school = $educationData['school'];
                $education->degree = $educationData['degree'];
                $education->field_of_study = $educationData['field_of_study'];
                $education->start_date = date('Y-m-d', strtotime($educationData['start_date']));
                $education->end_date = $educationData['end_date'] ? date('Y-m-d', strtotime($educationData['end_date'])) : null;
                $education->description = $educationData['description'];
                $education->user_id = Auth::user()->id;
                $education->save();
            }
    
            return redirect(route('dashboard'))->with('success', 'Mentor profile updated successfully');
            } else {
                Mentor::create([
                    'about' => $request->about,
                    'title' => $request->title,
                    'Skills' => $Skill,
                    'category_id' => $request->category_id,
                    'user_id' => Auth::user()->id,
                ]);
               
                // Save multiple experiences
            foreach ($request->input('experiences') as $experience) {

                if (strtotime($experience['start_date']) > strtotime($experience['end_date'])) {
                    return back()->withErrors(['error' => 'Start date cannot be after end date.'])->withInput();
                }


                Experience::create([
                    'user_id' => Auth::user()->id,
                    'title' => $experience['title'],
                    'company' => $experience['company'],
                    'start_date' => date('Y-m-d', strtotime($experience['start_date'])),
                   'end_date' => $experience['end_date'] ? date('Y-m-d', strtotime($experience['end_date'])) : null,
                    'description' => $experience['description'],
                ]);
            }


            
            // Save education records
            foreach ($request->education as $educationData) {
                $education = new Education;
                $education->school = $educationData['school'];
                $education->degree = $educationData['degree'];
                $education->field_of_study = $educationData['field_of_study'];
                $education->start_date = date('Y-m-d', strtotime($educationData['start_date']));
                $education->end_date = $educationData['end_date'] ? date('Y-m-d', strtotime($educationData['end_date'])) : null;
                $education->description = $educationData['description'];
                $education->user_id = Auth::user()->id;
                $education->save();
            }
    
            return redirect(route('dashboard'))->with('success', 'Mentor profile updated successfully');
            }

            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later');
        }
    }
    
    public function update(Request $request, $id){
        Mentor::where('id', $id)->update([
            'about'=>$request->about,
            'experiences'=>$request->experiences,
            'experience'=>$request->experience,
            'education'=>$request->education,
            'Skills'=>$request->Skills,
            'year_experience'=>$request->year_experience,
        ]);
        
        
       
        
    }

    public function edit(){
        $user = Auth::user();
        $mentor = Mentor::where('user_id', $user->id)->first();
        return view('auth.mentor.edit', compact('mentor'));
    }

    public function SessionPage(){
        return view('auth.mentor.session');
    }

    public function storeSession(Request $request){
        $request->validate([
            'session_title' => 'required|string',
            'session_price' => 'required|numeric',
        ]);
        

        try {
            if (is_array($request->session)) {
                foreach ($request->session as $sessionData) {
                    $session = new MentorApplication();
                    $session->session_title = $sessionData['session_title'];
                    $session->session_time = $sessionData['session_time'];
                    $session->session_price = $sessionData['session_price'];
                    $session->user_id = Auth::user()->id;
                    $session->save();
                }
            } else {
                // Handle the case where only one session's data is submitted
                $session = new MentorApplication();
                $session->session_title = $request->session_title;
                $session->session_time = $request->session_time;
                $session->session_price = $request->session_price;
                $session->user_id = Auth::user()->id;
                $session->save();
            }
            return back()->with('success','Session created successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later');;
        }
    }



    public function processSession(Request $request){
        $request->validate([ 
            'book_session'=>['required','string'],
            'book_session_price'=>['required','numeric'],
            'book_session_time_zone'=>[ 'required','string'],
            'minutes'=>[ 'required','string'],
            'book_session_date'=>[ 'required','date'],
            'user_id'=>[ 'required','numeric'],
            'mentor_id'=>[ 'required','numeric'],
        ]);

        try{

            // check if exist
            $booking = BookSession::where('book_session',$request->book_session)->first();
            if($booking){
                $booking->update([
                    'book_session'=>$request->book_session,
                    'book_session_price'=>$request->book_session_price,
                    'book_session_time_zone'=>$request->book_session_time_zone,
                    'minutes'=>$request->minutes,
                    'book_session_date'=>$request->book_session_date,
                    'user_id'=>$request->user_id,
                    'mentor_id'=>$request->mentor_id,
                ]);

                $user = User::find($request->mentor_id);
                // send mentor notification
                $user->notify(new MentorNotification($booking, $user));
                return redirect()->route('dashboard')->with('success', 'Session Booked Successfully');
            }else{
                $booking = new BookSession();
                $booking->book_session = $request->book_session;
                $booking->book_session_price = $request->book_session_price;
                $booking->book_session_time_zone = $request->book_session_time_zone;
                $booking->minutes = $request->minutes;
                $booking->book_session_date = $request->book_session_date;
                $booking->book_session_time = $request->book_session_time;
                $booking->user_id = Auth::user()->id;
                $booking->mentor_id = $request->mentor_id;
                $booking->save();

                $user = User::find($request->mentor_id);
                // send mentor notification
                $user->notify(new MentorNotification($booking, $user));
                return redirect()->route('dashboard')->with('success', 'Session Booked Successfully');
            }    
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong, please try again later');
        }
    }


    public function acceptBooking(Request $request){
        try{
            
         $session = BookSession::find($request->id);
         if ($session->mentor_id != Auth::user()->mentor->user_id) {
                return back()->with('error', 'Request not found or you are not authorized to accept this request.');
            }

            $session->update([
                'status' => 1,
            ]);
            // Send email notification to the user
            $userMentor = User::where('id', $session->mentor_id)->first();
            Mail::to($session->user->email)->send(new MentorAccepted($session, $userMentor));
            return back()->with('success', 'Request accepted successfully!');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }

}
