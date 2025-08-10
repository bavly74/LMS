<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/instructor/dashboard', function () {
    return view('instructor.dashboard');
})->middleware(['auth:instructor', 'verified'])->name('student.dashboard');




Route::group(['middleware' => ['auth:web', 'verified'] , 'prefix'=>'student' , 'as'=>'student.'] , function () {
    Route::get('dashboard', function () {
       return view('dashboard');
    })->middleware(['auth:web', 'verified'])->name('dashboard');

});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/instructor.php';
