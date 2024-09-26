<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Education;
use App\Models\Experience;
use App\Models\MentorApplication;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
public function index(){
    $tutor = User::orderBy('id', 'desc')->get();
    $categories = Category::orderBy('id', 'asc')->get();
    $mentors = User::where('role', 'mentor')->get();

        // dd(vars: $mentors); 
    $counts = [];

    foreach ($categories as $category) {
        $counts[$category->id] = Course::where('category_id', $category->id)->count();
    }

    return view('frontend.index', compact('counts', 'tutor', 'categories', 'mentors'));
}


// public function CategoryCourses(){
//     $categories = Category::orderBy('id', 'asc')->get();
//     $courses = Course::where('category_id', request('id'))->paginate(12);
//     return view('frontend.course', compact('courses', 'categories'));
// }


public function becomeMentor(){
    return view('frontend.page-become-mentor');
}


public function CategoryCourses($slug) {
    $categories = Category::orderBy('id', 'asc')->get();
    // Fetch the category by slug
    $category = Category::where('slug', $slug)->firstOrFail();
    // Fetch courses associated with this category
    $courses = Course::where('category_id', $category->id)->paginate(12);
    return view('frontend.course', compact('courses', 'categories', 'category'));
}


    public function about(){
        $countUser = User::count();
        $countCourse = Course::count();
        $countReview = Review::count();
        return view('frontend.about', compact('countUser', 'countCourse', 'countReview'));
    }

    public function contact(){
        return view('frontend.contact');
    }

    public function services(){
        return view('frontend.services');
    }

    public function course(){
        $courses = Course::orderBy('id', 'desc')->paginate(12);
        return view('frontend.course', compact('courses'));
    }

    public function courseDetails(Course $course){
        $recentCourse = Course::latest('id')->get()->take(4);
        return view('frontend.course-details', compact('course','recentCourse'));
    }

    
    public function mentor(){
        $users = User::where('role', 'mentor')->whereNotNull('id')->paginate(16);
        // dd($users); 
        return view('frontend.mentor', compact('users'));
    }
    

    public function showMentor($id){
        $users = User::findOrFail($id);
        $educations = Education::where('user_id', $users->id)->get();
        $experiences = Experience::where('user_id', $users->id)->get();
        $Usersession = MentorApplication::where('user_id', $users->id)->get();
        return view('frontend.showmentor', compact('users','educations', 'experiences', 'Usersession'));
    }


    public function contactStore(Request $request){
       $request->validate([ 
           'name'=> 'required|string',
           'email'=> 'required|string',
           'message'=> 'required',
        ]);

        
    }
}

