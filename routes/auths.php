<?php


use App\Http\Controllers\User\BankController;
use App\Http\Controllers\User\CourseController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\MentorController;
use App\Http\Controllers\User\MettingController;
use App\Http\Controllers\User\PaymentController;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;









Route::prefix('dashboard')->group(function (){
    Route::middleware(['auth','verified','last.activity.user'])->group(function (){
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
        Route::get('/proposal/{id}/details', [HomeController::class, 'viewProposal'])->name('proposal.details');
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
        Route::get('/course/classes', [HomeController::class, 'Classes'])->name('course.class');
        Route::get('/course/{id}/classes', [HomeController::class, 'History'])->name('show.proposal');
        

        // history
        Route::get('/history', [HomeController::class, 'History'])->name('show.history');

        // payment
        Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('pay');
        Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('callback.payment');
        Route::post('/payment/webhook', [PaymentController::class, 'WebhookGatewayCallback'])->name('paystack.webhook');
        
        // Create Meeting
        // Route::post('/create/meeting',[MettingController::class, 'createMeeting'])->name('createMeeting');

        //mentor
        Route::get('/mentor',[MentorController::class, 'index'])->name('user.mentor.index');
        Route::get('/mentor/create', [MentorController::class, 'create'])->name('mentor.create');
        Route::post('/mentor/store', [MentorController::class, 'store'])->name('mentor.store');
        Route::get('/mentor/session', [MentorController::class, 'SessionPage'])->name('mentor.session');
        Route::post('/mentor/session/store', [MentorController::class, 'storeSession'])->name('mentor.session.store');
        
        // Route::get('/mentor/{id}/edit', [MentorController::class, 'edit'])->name('mentor.edit');
        // Route::put('/mentor/{id}/update', [MentorController::class, 'update'])->name('mentor.update');

        // Session
        Route::post('/session/store', [MentorController::class, 'processSession'])->name('process.session.store');
        Route::post('/session/request/accept', [MentorController::class, 'acceptBooking'])->name('accept.booking');
        Route::post('/session/request/reject', [MentorController::class, 'rejectBooking'])->name('reject.booking');
        Route::delete('/session/{id}/delete', [MentorController::class, 'deleteSession'])->name('delete.booking');

        // Classes
        Route::get('/mentor/classes', [MentorController::class, 'myClass'])->name('mentor.classes');
        Route::post('/classes/store', [MentorController::class, 'storeClasses'])->name('store.classes');

        // Add Bank
        Route::post('/add-bank',[BankController::class, 'addBank'])->name('add.bank');

        // // Meeting
        // Route::get('/meeting', [MentorController::class, 'meeting'])->name('meeting');
        // Route::post('/meeting/store', [MentorController::class, 'storeMeeting'])->name('store.meeting');

    });
});

