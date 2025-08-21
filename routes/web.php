<?php

use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\Student\ProfileController;
use Illuminate\Support\Facades\Route;

/*
 * ---------------------------------------
 * Front End Routes
 * ---------------------------------------
 * */

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
 * ---------------------------------------
 * End Front End Routes
 * ---------------------------------------
 * */

Route::get('/instructor/dashboard', function () {
    return view('instructor.dashboard');
})->middleware(['auth:instructor', 'verified'])->name('student.dashboard');


Route::group(['middleware' => ['auth:web', 'verified'] , 'prefix'=>'student' , 'as'=>'student.'] , function () {
    Route::get('dashboard', function () {
       return view('student.index');
    })->middleware(['auth:web', 'verified'])->name('dashboard');

    Route::group(['prefix'=>'profile' , 'as'=>'profile.'] , function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::patch('/update/{user}', [ProfileController::class, 'update'])->name('update');
    });
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/instructor.php';
