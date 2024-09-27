<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\RequestAccepted;
use App\Mail\TutorMailRequest;
use App\Models\Award;
use App\Models\Awards;
use App\Models\BookSession;
use App\Models\Category;
use App\Models\Course;
use App\Models\Education; 
use App\Models\Experience;
use App\Models\Payment;
use App\Models\Proposal;
use App\Models\Review;
use App\Models\syllabus;
use App\Models\Tutor;
use App\Models\User;
use App\Notifications\RequestNotification;
use App\Traits\FirebaseStorageTrait;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Share;

class HomeController extends Controller
{

    use FirebaseStorageTrait;

    
    public function index() {
        try{
            $user = Auth::user();
            $proposals = Proposal::where('user_id', $user->id)->where('status', '3')->get();

            $countEnroll = Proposal::where('user_id', $user->id)->where('status', '4')->count();

            $PendingCountEnroll = Proposal::where('user_id', $user->id)->where('status', '3')->count();

            $SessionCount = BookSession::where('user_id', $user->id)->where('status', null)->count();

            
            $SessionPendingCount = BookSession::where('user_id', $user->id)->where('status', '0')->count();
            $SessionAcceptedCount = BookSession::where('user_id', $user->id)->where('status', '1')->count();
            $SessionRejectedCount = BookSession::where('user_id', $user->id)->where('status', '2')->count();
            

            $lastMonth = CarbonPeriod::create(Carbon::now()->subDays(29), Carbon::now());
            $lastMonthOrders = [];
            foreach ($lastMonth as $date) {
            $lastMonthOrders['days'][] = $date->format("l");
            
            // Here is the count part that you need
            $lastMonthOrders['orders'][] = DB::table('book_sessions')->whereDate('created_at', '=', $date)->count(); 
            }
            $dashboard_infos['lastMonthOrders'] = $lastMonthOrders;

            // dd($dashboard_infos);


            // fetch all totalReview send to tutor
           $TotalReview  = Review::where('user_id', $user->id)->count();
           // tutor
           $proposal = Proposal::where('tutor_id', $user->id)->get(); 
            
            $enrolledCourses = [];
        
            foreach ($proposals as $pro) {
                $course = Course::find($pro->course_id);
                if ($course) {
                    // Add the course and its corresponding proposal to the array
                    $enrolledCourses[] = [
                        'course' => $course,
                        'proposal' => $pro,
                    ];
                }
            }
        
            return view('user.dashboard', compact(
                'enrolledCourses','TotalReview',
                'user','proposal',
                'PendingCountEnroll', 'countEnroll', 'SessionPendingCount'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return Redirect::back()->with('error', 'Something went wrong, please try again later.');
        }
    }
    
    
    


    
  

    public function proposal(){
        try {
            // Get the latest proposal for the authenticated user
            $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();    
            return view('user.proposal', compact('proposal'));
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
            return redirect(route('proposal.index'));
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
                    'end_time' => $request->end_time,
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
                    'end_time' => $request->end_time,
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
        return view('user.tutor', compact('tutors'));
    }

    public function tutorProfile($id){
        try{
            $user = User::findOrFail($id);
            $tutor = Tutor::where('user_id', $user->id)->firstOrFail();
            $educations = Education::where('user_id', $tutor->user->id)->get();
            $experiences = Experience::where('user_id',  $tutor->user->id)->get();
            $certifications = Awards::where('user_id',  $tutor->user->id)->get();
            return view('user.tutor-profile', compact('tutor', 'user', 'educations', 'certifications', 'experiences'));
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
        
            return redirect()->route('dashboard')->with('success', 'Request sent successfully!');
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

    public function editProfile(){
        $profile = Auth::user();
        if (!$profile) {
            return redirect()->route('login');
        }
        return view('user.profile.edit', compact('profile'));
    }

    
    public function profile(){
        $profile = Auth::user();
        if (!$profile) {
            return redirect()->route('login');
        }
        $baseUrl = route('profile.show');
        $queryParams = http_build_query(['username' => $profile->username]);
        $url = "{$baseUrl}?{$queryParams}";
        $shareButtons = Share::page($url, 'Share title')
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp();
            // dd($shareButtons);
        return view('user.profile.profile', compact('profile', 'shareButtons'));
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
                $image_file = $this->uploadFileToFirebase($request->file('image'), 'profile/');
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
            
            return view('user.course', compact('enrolledCourses', 'user', 'proposals'));
        } catch(\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'Oops something went wrong');
        }
    }
    
    

    public function paymentHistory($id)
    {
        try{
            $history = Proposal::find($id);
            if (!$history) {
                return back()->with('error', 'Record not found.');
            }
            return view('user.history', compact('history'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }

    public function History(){
        try {
            $history = Proposal::where('user_id', Auth::user()->id)->where('status', '1')->get();
            $sessionHistory = BookSession::where('user_id', Auth::user()->id)->where('status', '1')->get();
            // dd($sessionHistory);

            $transactions = [];

            // Loop through the Proposal history
            foreach ($history as $proposal) {
                $transaction = [
                    'id' => $proposal->id, 
                    'date' => $proposal->created_at->format('Y:m:d H:i:s'),
                    'type' => 'proposal',
                    'amount' => $proposal->price, 
                    'status' => $proposal->status,
                    'course_title' => $proposal->course->title ?? 'N/A', 
                ];
                $transactions[] = $transaction;
            }

            // Loop through the BookSession history
            foreach ($sessionHistory as $session) {
                $transaction = [
                    'id' => $session->id, 
                    'date' => $session->created_at->format('Y:m:d H:i:s'),
                    'type' => 'session',
                    'amount' => $session->book_session_price, 
                    'status' => $session->status,
                    'session_title' => $session->book_session ?? 'N/A', 
                ];
                $transactions[] = $transaction;
            }

            // Sort transactions by date
            usort($transactions, function ($a, $b) {
                return $a['date'] <=> $b['date'];
            });

            // Pass the transactions to the view
            return view('user.history', compact('transactions'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }
    

    public function Classes(){
        try{
            $proposalDetails = Proposal::where('user_id', Auth::user()->id)->where('status', '1')->get();
            $sessions = BookSession::where('user_id', Auth::user()->id)->where('status', '1')->get();

            $transactions = [];
            foreach ($sessions as $session)
            {
                $transaction = [
                    'id'=> $session->id,
                    'date' => $session->created_at->format('d/m/Y'), 
                    'meeting_date' => $session->zoom_meeting_start_time, 
                    'meeting_url' => $session->zoom_meeting_url, 
                    'type'=> 'Session',
                    'status'=> $session->status,
                    'price'=> $session->book_session_price,
                    'meeting_password' => $session->zoom_meeting_password,
                    'title' => $session->book_session ?? 'N/A', 
                ];
                $transactions[] = $transaction;
            }

            // Loop through the Proposal history
            foreach ($proposalDetails as $proposal) {
                $transaction = [
                    'id'=> $proposal->id,
                    'date' => $proposal->created_at->format('d/m/Y'), 
                    'meeting_date' => $proposal->zoom_meeting_start_time, 
                    'meeting_url' => $proposal->zoom_meeting_url,
                    'type'=> 'Course',
                    'price'=> $proposal->price,
                    'status'=> $proposal->status,
                    'meeting_password' => $proposal->zoom_meeting_password,
                    'title' => $proposal->course->title ?? 'N/A', 
                ];
                $transactions[] = $transaction;
            }

            

            // Sort transactions by date
            usort($transactions, function ($a, $b) {
                return $a['date'] <=> $b['date'];
            });

            // Pass the transactions to the view

            return view('user.show-proposal', compact('proposalDetails', 'transactions'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong, please try again later.');
        }
    }




}
