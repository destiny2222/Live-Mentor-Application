<?php

namespace App\Livewire;

use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

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

    public function save(){

        // dd($this->day); 
        // Find the latest proposal for the user
        $proposal = Proposal::where('user_id', Auth::user()->id)->latest()->first();
        if($proposal){
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
        return redirect(route('preference.listTutor'))->with('success', 'Your preference has been saved!' );

    }

    public function render()
    {
        return view('livewire.preference');
    }

}
