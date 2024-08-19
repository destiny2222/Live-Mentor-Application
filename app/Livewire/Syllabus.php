<?php

namespace App\Livewire;

use App\Models\Syllabus as SyllabusModel;
use App\Models\Tutor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Syllabus extends Component
{
    public $category_id;
    public $tutor_id;
    public $description;

    public function mount()
    {
        $tutor = Tutor::where('user_id', Auth::user()->id)->first();
        $this->tutor_id = $tutor->id;
    }

    public function submit()
    {
        $this->validate([
            'category_id' => 'required|integer',
            'tutor_id' => 'required|integer',
        ]);

        dd($this->all());
        // Check if the category already exists for the tutor
        $existingSyllabus = SyllabusModel::where('category_id', $this->category_id)
                                         ->where('tutor_id', $this->tutor_id)
                                         ->first();

        if ($existingSyllabus) {
            return back()->with('error', 'This category already exists for the tutor.');
        }

        // Create new syllabus entry
        SyllabusModel::create([
            'category_id' => $this->category_id,
            'tutor_id' => $this->tutor_id,
            'description' => $this->description,
            'user_id' => Auth::user()->id,
        ]);


        return back()->with('success', 'Syllabus details stored successfully!');
    }

    public function render()
    {
        $tutor = Tutor::where('user_id', Auth::user()->id)->with('categories')->first();
        $categories = $tutor ? $tutor->categories : [];

        return view('livewire.syllabus', compact('categories'));
    }
}
