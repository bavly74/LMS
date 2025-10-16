<?php

use App\Http\Controllers\Instructor\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Instructor\Auth\PasswordController;
use App\Http\Controllers\Instructor\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Instructor\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Instructor\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Instructor\Auth\NewPasswordController;
use App\Http\Controllers\Instructor\Auth\PasswordResetLinkController;
use App\Http\Controllers\Instructor\Auth\RegisteredUserController;
use App\Http\Controllers\Instructor\Auth\VerifyEmailController;
use App\Http\Controllers\Instructor\Course\CourseContentController;
use App\Http\Controllers\Instructor\Course\CourseController;
use App\Http\Controllers\Instructor\ProfileController;
use Illuminate\Support\Facades\Route;


Route::group( ["middleware"=>"guest:instructor", "prefix"=>"instructor" , "as"=>"instructor."] , function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::group(["auth:instructor" ,"prefix"=>"instructor" , "as"=>"instructor."] , function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

/*
 Instructor Routes
 */
Route::group(['middleware' => ['auth:instructor' ,'verified' , 'instructorStatus'], 'prefix'=>'instructor' , 'as'=>'instructor.'], function () {
    Route::get('/dashboard',function (){
       return view('instructor.index');
    })->name('dashboard');

    Route::group(['prefix'=>'profile' , 'as'=>'profile.'], function () {
        Route::get('/',[ProfileController::class,'index'])->name('index');
        Route::patch('/update/{instructor}',[ProfileController::class,'update'])->name('update');
    });

    Route::group(['prefix'=>'course' , 'as'=>'course.'], function () {
        Route::get('/',[CourseController::class,'index'])->name('index');
        Route::get('/create',[CourseController::class,'create'])->name('create');
        Route::post('/store',[CourseController::class,'store'])->name('store');
        Route::get('{course_id}/edit',[CourseController::class,'edit'])->name('edit');
        Route::patch('/update',[CourseController::class,'update'])->name('update');
        Route::get('course-chapter-modal',[CourseContentController::class,'courseChapterModal'])->name('course-chapter-modal');
    });


}) ;

Route::group(['prefix' => '/instructor/laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
