<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\User\MentorController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\User\MeetingController;
use Illuminate\Http\Request;
use App\Models\BookSession;
use Jubaer\Zoom\Facades\Zoom;
use Illuminate\Support\Str;






Route::get('/',[FrontController::class, 'index'])->name('index');
Route::get('/about',[FrontController::class, 'about'])->name('about');
// Route::get('/contact',[FrontController::class, 'contact'])->name('contact');
// Route::get('/service',[FrontController::class, 'service'])->name('service');

// course route
Route::get('/course', [FrontController::class, 'course'])->name('course.index');
Route::get('/courses/category/{slug}', [FrontController::class, 'CategoryCourses'])->name('category.courses');
Route::get('/course/details/{course}', [FrontController::class, 'courseDetails'])->name('course.details');
Route::get('/search', [SearchController::class, 'searchEngine'])->name('search');
Route::get('/mentor', [FrontController::class, 'mentor'])->name('mentor.index');
Route::get('/mentor/{id}/details', [FrontController::class, 'showMentor'])->name('mentor.show');
// Create Meeting
Route::post('/create/meeting',[MeetingController::class, 'createMeeting'])->name('createMeeting');
Route::get('/meeting', function(){
    return view('meeting');
});

Route::get('/join-meeting/{meetingDetails}', [MeetingController::class, 'joinMeeting'])->name('zoom.join');


Route::post('/uploaded', function(Request $request){
    
});


require __DIR__.'/auths.php'; 
require __DIR__.'/admin.php'; 