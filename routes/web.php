<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\User\MettingController;
use App\Http\Controllers\User\SearchController;
use Illuminate\Support\Facades\Route;





Route::get('/',[FrontController::class, 'index'])->name('index');
// Route::get('/about',[FrontController::class, 'about'])->name('about');
// Route::get('/contact',[FrontController::class, 'contact'])->name('contact');
// Route::get('/service',[FrontController::class, 'service'])->name('service');

// course route
Route::get('/course', [FrontController::class, 'course'])->name('course.index');
Route::get('/courses/category/{slug}', [FrontController::class, 'CategoryCourses'])->name('category.courses');
Route::get('/course/details/{course}', [FrontController::class, 'courseDetails'])->name('course.details');
Route::get('/search', [SearchController::class, 'searchEngine'])->name('search');
// Create Meeting
Route::post('/create/meeting',[MettingController::class, 'createMeeting'])->name('createMeeting');

Route::get('/meeting', function(){
    return view('meeting');
});


require __DIR__.'/auths.php'; 
require __DIR__.'/admin.php'; 