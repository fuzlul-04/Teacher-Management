<?php

use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('teachers', TeacherController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('classes', ClassController::class);
        Route::get('reports/monthly', [TeacherController::class, 'monthlyReport'])->name('reports.monthly');
    });
});

Route::get('rate/{class}', [RatingController::class, 'create'])->name('ratings.create');
Route::middleware('auth')->group(function () {
    Route::post('rate/{class}', [RatingController::class, 'store'])->name('ratings.store');
});

Route::get('/new-admission', [StudentController::class, 'newAdmissionForm'])->name('students.new-admission');
Route::post('/check-student', [StudentController::class, 'checkStudent'])->name('students.check');

Route::get('/student-registration', [StudentController::class, 'create'])->name('students.register');
Route::post('/student-registration', [StudentController::class, 'store'])->name('students.store');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

require __DIR__.'/auth.php';
