<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
// use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\EnsureUserIsCompany;
use App\Http\Controllers\Api\Company\JobApiController;
use App\Http\Controllers\Api\Company\UserAppApiController;
use App\Http\Controllers\Api\User\ApplicationApiController;
use App\Http\Controllers\Api\ProfileController;

// 🔹 ROUTE AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// 🔹 ROUTE POST JOB (HANYA USER LOGIN)
Route::middleware(['auth:sanctum', EnsureUserIsCompany::class])->group(function () {
    Route::get('/jobs', [JobApiController::class, 'index']);
    Route::post('/jobs', [JobApiController::class, 'store']);
    // Route::get('/jobs/{id}', [JobApiController::class, 'show']);
    Route::put('/jobs/{id}', [JobApiController::class, 'update']);
    Route::delete('/jobs/{id}', [JobApiController::class, 'destroy']);
    // Rute lain yang memerlukan peran 'company'
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    // 🔹 LOGOUT
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/jobslist', [ApplicationApiController::class, 'index']); // Get all jobs
    Route::post('/jobs/{job}/apply', [ApplicationApiController::class, 'apply']); // Apply for a job
    Route::get('/my-applied-jobs', [ApplicationApiController::class, 'appliedJobs']); // Get applied jobs

    Route::get('/applications', [UserAppApiController::class, 'index']);
    Route::put('/applications/{id}', [UserAppApiController::class, 'update']);

});