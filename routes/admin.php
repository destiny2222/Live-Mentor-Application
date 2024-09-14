<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TutorController;
use App\Http\Controllers\Admin\MentorController;
use App\Http\Controllers\Admin\UserManagementController;
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
        Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
        Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
        Route::get('/course/{id}/edit', [CourseController::class, 'edit'])->name('course.edit');
        Route::put('/course/{id}/update', [CourseController::class, 'update'])->name('course.update');
        Route::delete('/course/{id}/delete', [CourseController::class, 'delete'])->name('course.delete');

        // category
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');

        // user
        Route::get('/user', [UserManagementController::class, 'index'])->name('user.index');
        Route::get('/user/{id}/edit', [UserManagementController::class, 'edit'])->name('user.edit');
        Route::put('/user/{id}/update', [UserManagementController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}/delete', [UserManagementController::class, 'delete'])->name('user.delete');

        // tutor
        Route::get('/user/tutor', [TutorController::class, 'index'])->name('tutor.index');
        // Route::get('/user/tutor/create', [TutorController::class, 'create'])->name(name: 'tutor.create');
        // Route::post('/user/tutor/store', [TutorController::class,'store'])->name('tutor.store');
        Route::get('/user/tutor/{id}/edit', [TutorController::class, 'edit'])->name('tutor.edit');
        Route::put('/user/tutor/{id}/update', [TutorController::class, 'update'])->name('tutor.update');
        Route::delete('/user/tutor/{id}/delete', [TutorController::class, 'delete'])->name('tutor.delete');

        // mentor
        Route::get('/user/mentor', [MentorController::class, 'index'])->name('mentor.index');
        Route::get('/user/mentor/{id}/edit', [MentorController::class, 'edit'])->name('mentor.edit');
        Route::put('/user/mentor/{id}/update', [MentorController::class, 'update'])->name('mentor.update');
        Route::delete('/user/mentor/{id}/delete', [MentorController::class, 'delete'])->name('mentor.delete');


    });
    
});