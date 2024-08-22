<?php


use App\Http\Controllers\User\CourseController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\MettingController;
use App\Http\Controllers\User\PaymentController;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;








Route::prefix('dashboard')->group(function (){
    Route::middleware(['auth','verified'])->group(function (){
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/tutor/upload', [HomeController::class, 'tutor'])->name('tutor.create');
        Route::post('/tutor/store', [HomeController::class, 'storeTutor'])->name('tutor.store');
        // Route::get('/tutor/show/{id}', [HomeController::class, 'show'])->name('tutor.show');
        Route::get('/tutor/syllabus', [HomeController::class, 'syllabus'])->name('syllabus.index');
        Route::post('/tutor/syllabus/store', [HomeController::class, 'syllabusStore'])->name('syllabus.store');
        Route::get('/proposal', [HomeController::class, 'proposal'])->name('proposal.index');
        Route::post('/proposal/store', [HomeController::class, 'proposalStore'])->name('proposal.store');
        Route::post('/preference/store', [HomeController::class, 'savePreference'])->name('preference.store');
        Route::get('/preference/tutor', [HomeController::class, 'listTutor'])->name('preference.listTutor');
        Route::get('/tutor/{id}/profile', [HomeController::class, 'tutorProfile'])->name('tutor.profile');
        Route::post('/tutors/{tutor_id}/reviews', [HomeController::class, 'storeReview'])->name('review.store');
        // send tutor request
        Route::post('/tutor/request', [HomeController::class, 'sendTutorRequest'])->name('tutor.request');
        Route::get('/tutor/proposal', [HomeController::class, 'getTutorProposal'])->name('tutor.proposal');

        // tutor request
        Route::post('/tutor/request/cancel', [HomeController::class, 'cancelTutorRequest'])->name('tutor.request.cancel');
        Route::post('/tutor/request/accept', [HomeController::class, 'acceptRequest'])->name('tutor.request.accept');
        // Route::get('/tutor/request/{id}/reject', [HomeController::class, 'rejectTutorRequest'])->name('tutor.request.reject');

        // edit profile
        Route::get('/profile', [HomeController::class, 'profile'])->name('profile.index');
        Route::put('/profile/{id}/update', [HomeController::class, 'updateProfile'])->name('profile.update');
        Route::post('/profile/update/password', [HomeController::class, 'changePassword'])->name('profile.update.password');
        Route::delete('/user/delete', [HomeController::class, 'destroyUser'])->name('user.destroy');

        //course
        Route::get('/course', [HomeController::class, 'EnrollCourse'])->name('enroll-course');

        // payment
        Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('pay');
        
        // Create Meeting
        // Route::post('/create/meeting',[MettingController::class, 'createMeeting'])->name('createMeeting');

         

        Route::get('/upload', function(){
            return view('upload');
        });

    });
});
    




Route::post('/upload/store', function(Request $request){
    $cloudinaryImage = $request->file('file')->storeOnCloudinary('products');
    $url = $cloudinaryImage->getSecurePath();
    $public_id = $cloudinaryImage->getPublicId();
    // $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();
    // dd($uploadedFileUrl);
    // dd($url);
    dd($public_id);
})->name('upload.store');

