<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\EnrollmentDataController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\User\GoogleAuthController;
use App\Http\Controllers\User\GroupController;
use App\Http\Controllers\User\MeetingController;
use App\Http\Controllers\User\MentorController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\ZoomController;
use App\Models\BookSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Jubaer\Zoom\Facades\Zoom;












Route::get('/',[FrontController::class, 'index'])->name('index');
Route::get('/about',[FrontController::class, 'about'])->name('about');
Route::get('/contact',[FrontController::class, 'contact'])->name('contact');
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

// google authentication
Route::get('/auth/google/redirect', [GoogleAuthController::class , 'redirect'])->name('auth.socialite.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class , 'callback'])->name('auth.socialite.callback');
Route::get('/auth/role', [GoogleAuthController::class, 'handleGoogle'])->name('auth.redirect.google');
        Route::post('/auth/role/store', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.role.post');

// share profile
Route::get('/share/profile', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/start-mentoring', [FrontController::class, 'becomeMentor'])->name('become.mentor');

Route::get('/enrollment-data', [EnrollmentDataController::class, 'getEnrollmentData']);
Route::get('/analytics-data', [AnalyticsController::class, 'getAnalyticsData']);

Route::get('/session/{groupSession}', [FrontController::class, 'groupSession'])->name('group.session');


require __DIR__.'/auths.php'; 
require __DIR__.'/admin.php'; 