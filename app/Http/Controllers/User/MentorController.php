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
use App\Models\User;
use App\Notifications\MentorNotification;
use App\Notifications\MentorRejected;
use App\Traits\FirebaseStorageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class MentorController extends Controller
{
    public function index(){
        $Applications = MentorApplication::where('user_id', Auth::user()->id)->get();
        return view('user.mentor.index', compact('Applications'));
    }

    
   
    
    public function create(){
        $categories = Category::orderBy('id', 'desc')->get();
        return view('user.mentor.create', compact('categories'));
    }

    public function store(Request $request) {
        $rules = [
            'title' => 'required|string',
            'about' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Validate experience dates
        $dateErrors = [];
        foreach ($request->input('experiences', []) as $key => $experience) {
            if (!empty($experience['start_date']) && !empty($experience['end_date'])) {
                if (strtotime($experience['start_date']) > strtotime($experience['end_date'])) {
                    $dateErrors[] = "Experience #" . ($key + 1) . ": Start date cannot be after end date.";
                }
            }
        }
    
        if (!empty($dateErrors)) {
            return back()->withErrors($dateErrors)->withInput();
        }
    
        try {
            $mentor = Mentor::updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'about' => $request->about,
                    'title' => $request->title,
                    'Skills' => $request->input('skills', []),
                    'experience' => $request->experience,
                ]
            );
    
            // Sync categories
            $mentor->categories()->sync($request->categories);
            
            // Save experiences
            foreach ($request->input('experiences', []) as $experience) {
                Experience::create([
                    'user_id' => Auth::user()->id,
                    'title' => $experience['title'],
                    'company' => $experience['company'],
                    'start_date' => date('Y-m-d', strtotime($experience['start_date'])),
                    'end_date' => !empty($experience['end_date']) ? date('Y-m-d', strtotime($experience['end_date'])) : null,
                    'description' => $experience['description'],
                ]);
            }
    
            // Save education records
            foreach ($request->input('education', []) as $educationData) {
                $education = new Education;
                $education->school = $educationData['school'];
                $education->degree = $educationData['degree'];
                $education->field_of_study = $educationData['field_of_study'];
                $education->start_date = date('Y-m-d', strtotime($educationData['start_date']));
                $education->end_date = !empty($educationData['end_date']) ? date('Y-m-d', strtotime($educationData['end_date'])) : null;
                $education->description = $educationData['description'];
                $education->user_id = Auth::user()->id;
                $education->save();
            }
    
            return redirect(route('dashboard'))->with('success', 'Mentor profile updated successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later');
        }
    }
    

    public function bookSession(){
        $bookings = BookSession::where('mentor_id', Auth::user()->id)->get();
        return view('user.mentor.show', compact('bookings'));
    }
    

    public function SessionCreate(){
        return view('user.mentor.session');
    }

    public function storeSession(Request $request){
        $request->validate([
            'session_title' => ['required' ,'string'],
            'session_price' => ['required', 'numeric'],
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
            return redirect()->route('user.mentor.index')->with('success','Session created successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later');;
        }
    }


    public function updateSession(Request $request, $id){

        try{
            $session = MentorApplication::findOrFail($id);
            $session->update([
                'session_title'=> $request->input('session_title'),
                'session_time' => $request->input('session_time'),
                'session_price' => $request->input('session_price'),
                'user_id' => Auth::user()->id,
            ]);
            return back()->with('success', ' Updated Successfully');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong, please try again later');
        }
    }


    public function deleteSessionApplication($id){
        try{
            $session = MentorApplication::findOrFail($id);
            $session->delete();
            return back()->with('success', 'Deleted Successfully');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong, please try again later');
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

    public function rejectBooking(Request $request){
        try{
            $session = BookSession::find($request->id);
            if ($session->mentor_id != Auth::user()->mentor->user_id) {
                return back()->with('error', 'Request not found or you are not authorized to reject this request.');
            }
            $session->update([
                'status' => 2,
                'message'=>$request->input('message'),
            ]);
            // Send email notification to the user
            $User = User::where('id', $session->user_id)->first();
            $User->notify(new MentorRejected($session, $User));
            return back()->with('success', 'Request rejected successfully!');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }


    public function deleteSession($id){
        try{
            $session = BookSession::find($id);
            if ($session->mentor_id != Auth::user()->mentor->user_id) {
                return back()->with('error', 'Request not found or you are not authorized to reject this request.');
            }
            $session->delete();
            return back()->with('success', 'Session deleted successfully!');
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');

        }
    }


    public function myClass(){
        $sessions = BookSession::where('mentor_id', Auth::user()->mentor->user_id)->where('status', 1)->get();
        return view('user.mentor.myClass', compact('sessions'));
    }




}
