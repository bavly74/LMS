<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\Course\CourseCategoryController;
use App\Http\Controllers\Admin\Course\CourseSubCategoryController;
use App\Http\Controllers\Admin\Course\LanguageController;
use App\Http\Controllers\Admin\Course\LevelController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InstructorController;
use Illuminate\Support\Facades\Route;

Route::group( ["middleware"=>"guest:admin", "prefix"=>"admin" , "as"=>"admin."] , function () {

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

Route::group(["auth:admin" ,"prefix"=>"admin" , "as"=>"admin."] , function () {
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
 * --------------------------------------------------------------------
 * Admin Routes
 * --------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth:admin' ,'verified'], 'prefix'=>'admin' , 'as'=>'admin.'], function () {
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');

    //-------------------instructor crud------------------------
    Route::group(['prefix'=>'instructor' , 'as'=>'instructor.' ], function () {
        Route::get('/pending',[InstructorController::class,'index'])->name('pending') ;
        Route::get('/approve/{instructor}',[InstructorController::class,'approve'])->name('approve') ;
        Route::get('/reject/{instructor}',[InstructorController::class,'reject'])->name('reject') ;
    });
    //-------------------end instructor crud------------------------


    //-------------------course crud------------------------
    Route::group(['prefix'=>'course' , 'as'=>'course.' ], function () {
        //-------------------course language crud------------------------
        Route::group(['prefix'=>'language' , 'as'=>'language.' ], function () {
            Route::get('/',[LanguageController::class,'index'])->name('index') ;
            Route::get('/create',[LanguageController::class,'create'])->name('create') ;
            Route::post('/store',[LanguageController::class,'store'])->name('store') ;
            Route::get('/edit/{language}',[LanguageController::class,'edit'])->name('edit') ;
            Route::patch('/update/{language}',[LanguageController::class,'update'])->name('update') ;
            Route::delete('/delete/{language}',[LanguageController::class,'delete'])->name('delete') ;
        });
        //-------------------end course language crud------------------------

        //-------------------course level crud------------------------
        Route::group(['prefix'=>'level' , 'as'=>'level.' ], function () {
            Route::get('/',[LevelController::class,'index'])->name('index') ;
            Route::get('/create',[LevelController::class,'create'])->name('create') ;
            Route::post('/store',[LevelController::class,'store'])->name('store') ;
            Route::get('/edit/{level}',[LevelController::class,'edit'])->name('edit') ;
            Route::patch('/update/{level}',[LevelController::class,'update'])->name('update') ;
            Route::delete('/delete/{level}',[LevelController::class,'delete'])->name('delete') ;
        });
        //-------------------end course level crud------------------------

        //-------------------course category crud------------------------
        Route::resource('category',CourseCategoryController::class);
        //-------------------end course category crud------------------------


        //------------------- course sub category crud------------------------
        Route::group(['prefix'=>'category' , 'as'=>'category.' ], function () {
            Route::group(['prefix'=>'sub-category' , 'as'=>'subcategory.' ], function () {
                Route::get('{category}/',[CourseSubCategoryController::class,'index'])->name('index') ;
                Route::get('{category}/create/',[CourseSubCategoryController::class,'create'])->name('create') ;
                Route::post('{category}/',[CourseSubCategoryController::class,'store'])->name('store') ;
                Route::get('edit/{subCategory}/',[CourseSubCategoryController::class,'edit'])->name('edit') ;
                Route::patch('update/{subCategory}/',[CourseSubCategoryController::class,'update'])->name('update') ;
                Route::delete('destroy/{subCategory}',[CourseSubCategoryController::class,'destroy'])->name('destroy') ;
            });
        });
        //-------------------end course sub category crud------------------------


    });
    //-------------------end course crud------------------------
}) ;
