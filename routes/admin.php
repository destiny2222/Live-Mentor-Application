<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;






Route::prefix('admin')->name('admin.')->group(function (){ 

    Route::middleware('admin.logged_out')->group(function () {
        Route::controller(LoginController::class)->group(function (){
            Route::get('login-form','showLoginForm')->name('login.form');
            Route::post('login','login')->name('login');
            Route::post('logout','logout')->name('logout');
        });
    });

    Route::middleware('admin.logged_in')->group(function () { 
        Route::get('/', [ HomeController::class,'home' ])->name('home');
        Route::get('/course', [CourseController::class, 'index'])->name('course.index');
        Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
        Route::get('/course/{id}/edit', [CourseController::class, 'edit'])->name('course.edit');
        Route::put('/course/{id}/update', [CourseController::class, 'update'])->name('course.update');
        Route::delete('/course/{id}/delete', [CourseController::class, 'delete'])->name('course.delete');


    });
    
});