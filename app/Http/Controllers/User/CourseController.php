<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
   public function index(){
       
   }

   public function courseDetails(Course  $course){
       return view('frontend.course-details',compact('course'));
   }


}
