<?php

namespace App\Livewire;

use App\Models\Tutor;
use App\Models\Course;
use Livewire\Component;
use App\Models\Category;
use App\Models\Proposal;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RequestNotification;
use App\Notifications\RequestNotificatiion;

class Preference extends Component
{
    public $prefer; 
    public $language;
    public $time;
    public $end_time;
    public $day = [];
    public $tutor_id;
    public $form_message; 
    public $course_id;
    public $save_find;
    public $save_request;
    public $loading = false; 

    public function save() {
        

        try {
            // Find the latest proposal for the user
            $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();
        
            if($proposal) {
                // Update the existing proposal
                $proposal->update([
                    'prefer' => $this->prefer,
                    'language' => $this->language,
                    'time' => $this->time,
                    'end_time' => $this->end_time,
                    'day' => $this->day, 
                    'tutor_id' => $this->tutor_id,
                    'user_id' => Auth::user()->id,
                    'course_id' => $proposal->course_id,
                    'additional_information' => $this->form_message, 
                ]);
            } else {
                // Create a new proposal
                Proposal::create([
                    'prefer' => $this->prefer,
                    'language' => $this->language,
                    'time' => $this->time,
                    'end_time' => $this->end_time,
                    'day' => $this->day, 
                    'tutor_id' => $this->tutor_id,
                    'user_id' => Auth::user()->id,
                    'course_id' => $this->course_id,
                    'additional_information' => $this->form_message,
                ]);
            }
        
            $saveFind = $this->save_find;
            $SaveRequest = $this->save_request;
        
            if (isset($saveFind)) {
                return redirect(route('preference.listTutor'))->with('success', 'Your preference has been saved!');
            } elseif (isset($SaveRequest)) {
                $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();
                if (!$proposal) {
                    return back()->with('error', 'No proposal found for the current user.');
                }
        
                $course = Course::find($proposal->course_id);
                if (!$course) {
                    return back()->with('error', 'No course found for the given proposal.');
                }
                
                $category = Category::find($course->category_id);
                if(!$category) {
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
                        'status'=> 3, 
                        // 'course_id'=> $proposal->course_id,
                    ]);
                    // send notification to the tutor's user
                    if ($tutor->user) {
                        $tutor->user->notify(new RequestNotification($user, $course));
                    }
                }
                $this->dispatchBrowserEvent('notice_message', ['message' => 'Your request was successfully']);
                return back()->with('success', 'Your request has been sent!');
            } else {
                return back()->with('error', 'Something went wrong!');
            } 
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'An error occurred: ');
        }
    }

    public function render()
    {
        return view('livewire.preference');
    }
}
