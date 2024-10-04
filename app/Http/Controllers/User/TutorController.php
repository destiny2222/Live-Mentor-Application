<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
// use App\Livewire\Syllabus;
use App\Http\Requests\StoreTutorRequest;
use App\Http\Requests\SyllabusRequest;
use App\Mail\RequestAccepted;
use App\Models\Awards;
use App\Models\Category;
use App\Models\Course;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Proposal;
use App\Models\syllabus;
use App\Models\Tutor;
use App\Models\User;
use App\Traits\FirebaseStorageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TutorController extends Controller
{
    use FirebaseStorageTrait;
    
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
                'is_approved' => true,
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


    public function storeTutor(StoreTutorRequest $request)
    {
        DB::beginTransaction();
        try {
            // Check if the user is already a tutor
            if ($request->user()->tutor) {
                return redirect()->back()->with('error', 'You have already submitted your details');
            }

            // Handle file upload
            $resumeFile = $request->hasFile('resume') 
                ? $this->uploadFileToFirebase($request->file('resume'), 'images/tutor/resume/')
                : null;

            // Process availability
            $availability = $this->processAvailability($request->input('days', []));
            
            // Create Tutor
            $tutor = new Tutor($request->safe()->only([
                'language', 'experience', 'description', 'price', 'title'
            ]));
            $tutor->skill = $request->input('skills', []);
            $tutor->resume = $resumeFile;
            $tutor->availability = $availability;
            $tutor->resume_public_id = $resumeFile;
            $tutor->user_id = Auth::id();
            $tutor->save();

            // Attach categories
            $tutor->categories()->attach($request->input('category_id', []));

            // Create Education
            Education::create($request->safe()->only([
                'school', 'degree', 'field_of_study', 'start_date', 'end_date', 'description'
            ]) + ['user_id' => Auth::id()]);

            // Create Award
            Awards::create($request->safe()->only([
                'award_title', 'company', 'date', 'date_end', 'description'
            ]) + ['user_id' => Auth::id(), 'title' => $request->input('award_title')]);

            // Create Experience
            Experience::create($request->safe()->only([
                'experience_title', 'company', 'start_date', 'end_date', 'description'
            ]) + ['user_id' => Auth::id(), 'title' => $request->input('experience_title')]);

            DB::commit();
            return redirect(route('syllabus.index'))->with('success', 'Tutor profile created successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error creating tutor profile', [
                'user_id' => Auth::id(),
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            ]);
            return back()->with('error', 'An error occurred while creating your tutor profile. Please try again.');
        }
    }



    private function processAvailability(array $days): array
    {
        $availability = [];
        foreach ($days as $day => $schedule) {
            $availability[$day] = [
                'available' => isset($schedule['available']),
                'start_time' => $schedule['start_time'] ?? null,
                'end_time' => $schedule['end_time'] ?? null,
            ];
        }
        return $availability;
    }



    public function syllabus()
    {
        try {
            $syllabus = syllabus::where('user_id', Auth::user()->id)->get();        
            return view('user.tutor.syllabus', compact( 'syllabus'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'An error occurred while loading the syllabus. Please try again later.');
        }
    }

    

    public function createSyllabus()
    {
        try {
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Please log in to view the syllabus.');
            }
    
            $tutor = Tutor::where('user_id', Auth::user()->id)
                        // ->where('', 1)
                        ->first();
            // dd($tutor);

            if (!$tutor) {
                return redirect()->route('tutor.create')->with('error', 'No tutor record found for your account.');
            }
    
            if (!$tutor->is_approved == 1) {
                return back()->with('error', 'Your tutor account has not been approved yet.');
            }

    
            // Ensure the categories relationship exists
            if (!$tutor->categories || $tutor->categories->isEmpty()) {
                return back()->with('error', 'You don\'t have any assigned categories.');
            }
    
            // Get all courses associated with the tutor's categories
            $tutorCourses = Course::whereIn('category_id', $tutor->categories->pluck('id'))->get();
            
            return view('user.tutor.create_syllabus', compact('tutorCourses'));
        } catch (\Exception $exception) {
            Log::error('Error in createSyllabus: ' . $exception->getMessage());
            return back()->with('error', 'An error occurred while creating the syllabus. Please try again later.');
        }
    }

    public function syllabusStore(SyllabusRequest $request){

        
        try{

            // Check if the category already exists for the tutor
            $existingSyllabus = syllabus::where('course_id', $request->course_id)->first();
                if($existingSyllabus){
                    return back()->with('error', 'Syllabus already exists for this category');
                }
            
            syllabus::updateOrCreate( [
                'course_id' => $request->course_id,
                'description' => $request->input('syllabus'),
                'price' => $request->price,
                'duration' => $request->duration,
                'user_id'=> Auth::user()->id,
            ]);

            return back()->with('success', 'Syllabus added successfully');
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }


    public function Editsyllabus($id){
        try{
            $syllabus = Syllabus::findOrFail($id);
            return view('user.tutor.edit_syllabus', compact( 'syllabus'));
        }catch(\Exception $exception){
           Log::error($exception->getMessage());
           return bacK()->with('error', 'Something went wrong, please try again');   
        }
    }


    public function UpdateSyllabus(SyllabusRequest $request, $id)
    {
        try {
            $syllabus = Syllabus::findOrFail($id);
    
            // Validate that the authenticated user owns this syllabus
            if ($syllabus->user_id !== Auth::id()) {
                return back()->with('error', 'You are not authorized to update this syllabus.');
            }
    
            // Combine syllabus items into a single string
            $description = is_array($request->input('syllabus')) 
                ? implode("\n", $request->input('syllabus')) 
                : $request->input('description');
    
            $syllabus->update([
                'course_id' => $request->input('course_id'),
                'description' => $description,
                'price' => $request->input('price'),
                'duration' => $request->input('duration'),
                // No need to update user_id as it shouldn't change
            ]);
    
            return back()->with('success', 'Syllabus updated successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'An error occurred while updating the syllabus. Please try again.');
        }
    }

    public function deleteSyllabus($id){
        try{
            $syllabus = Syllabus::findOrFail($id);
            $syllabus->delete();
            return back()->with('success', 'Syllabus deleted successfully');    
        }catch(\Exception $exception){
            Log::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }




}
