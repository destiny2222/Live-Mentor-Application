<?php


use App\Http\Controllers\User\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;





Route::prefix('dashboard')->group(function (){
    Route::middleware('authentication.user')->group(function (){
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

