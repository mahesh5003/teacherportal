<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';

Route::get('/', function () {return view('auth.login');});
Route::get('/dashboard', [StudentController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::post('/addnewstudent', [StudentController::class, 'store'])->name('student.add');
Route::get('/deletestudent/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
Route::get('/studentedit{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::post('/studentupdate', [StudentController::class, 'update'])->name('student.update');
Route::post('/studenteditenline', [StudentController::class, 'editInline'])->name('student.editenline');

});


