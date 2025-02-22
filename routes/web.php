<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Company\JobController;
use App\Http\Controllers\Company\UserApplicationController;
use App\Http\Controllers\User\ApplicationController;
use App\Http\Controllers\ProfileUserController;

    // Menampilkan form registrasi
Route::middleware(['web'])->group(function () {

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileUserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileUserController::class, 'update'])->name('profile.update');
    Route::resource('jobs-company', JobController::class);
    Route::get('/jobs/data', [JobController::class, 'data'])->name('jobs.data');

    Route::get('/application', [UserApplicationController::class, 'index'])->name('applications.index');
    // Route::get('/applications/data', [UserApplicationController::class, 'index'])->name('applications.data');

    Route::put('/applications/{id}', [UserApplicationController::class, 'update'])->name('applications.update');


    Route::get('/joblist', [ApplicationController::class, 'index'])
        ->name('user.dashboard');

    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'apply'])->name('jobs.apply');
    Route::get('/my-applied-jobs', [ApplicationController::class, 'indexMyApply'])->name('applied.jobs'); // View applied jobs
    Route::get('/my-applied-jobs/data', [ApplicationController::class, 'appliedJobs'])->name('applied.jobs.data'); // Data for DataTables
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
