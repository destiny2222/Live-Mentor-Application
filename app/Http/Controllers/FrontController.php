<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{
public function index(){
    $tutor = User::orderBy('id', 'asc')->get();
    $categories = Category::orderBy('id', 'asc')->get();
    $counts = [];

    foreach ($categories as $category) {
        $counts[$category->id] = Course::where('category_id', $category->id)->count();
    }

    return view('frontend.index', compact('counts', 'tutor', 'categories'));
}


// public function CategoryCourses(){
//     $categories = Category::orderBy('id', 'asc')->get();
//     $courses = Course::where('category_id', request('id'))->paginate(12);
//     return view('frontend.course', compact('courses', 'categories'));
// }


public function CategoryCourses($slug) {
    $categories = Category::orderBy('id', 'asc')->get();
    // Fetch the category by slug
    $category = Category::where('slug', $slug)->firstOrFail();
    // Fetch courses associated with this category
    $courses = Course::where('category_id', $category->id)->paginate(12);
    return view('frontend.course', compact('courses', 'categories', 'category'));
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
        $courses = Course::orderBy('id', 'desc')->paginate(12);
        return view('frontend.course', compact('courses'));
    }

    public function courseDetails(Course $course){
        $recentCourse = Course::latest('id')->get()->take(4);
        return view('frontend.course-details', compact('course','recentCourse'));
    }

    public function search(Request $request){
        $search = $request->input('search');
        $results = Course::where('name', 'like', "%$search%")->get();
        return view('products.index', ['results' => $results]);
    }


    // public function tutor(){
    //     return view('frontend.cart');
    // }
}

