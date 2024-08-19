<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $course = Course::orderBy('id', 'asc')->paginate(6);
        return view('frontend.index', compact('course'));
    }

    public function about(){
        return view('frontend.about');
    }

    public function contact(){
        return view('frontend.contact');
    }

    public function services(){
        return view('frontend.services');
    }

    public function course(){
        return view('frontend.course');
    }

    public function courseDetails(Course $course){
        $recentCourse = Course::latest('id')->get()->take(4);
        return view('frontend.course-details', compact('course','recentCourse'));
    }
}

