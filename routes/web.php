<?php

use App\Models\ApplyJob;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplyJobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ManpowerRequestController;
use App\Http\Controllers\ApplicantDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('manpower_requests', ManpowerRequestController::class);

    // Routes for approval and rejection (only for HR)
    Route::post('manpower_requests/{manpowerRequest}/approve', [ManpowerRequestController::class, 'approve'])->name('manpower_requests.approve')->middleware('can:approve,manpowerRequest');
    Route::post('manpower_requests/{manpowerRequest}/reject', [ManpowerRequestController::class, 'reject'])->name('manpower_requests.reject')->middleware('can:approve,manpowerRequest');


    Route::prefix('jobs')->name('jobs.')->group(function () {
        Route::get('/', [ApplyJobController::class, 'index'])->name('index');
        Route::get('create', [ApplyJobController::class, 'create'])->name('create');
        Route::post('store', [ApplyJobController::class, 'store'])->name('store');
    });

    Route::get('jobs/{jobId}/apply', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('jobs/{jobId}/apply', [ApplicationController::class, 'store'])->name('applications.store');

    // HR can view and manage applications
    Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
});
// Job listing page
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');

// Route to display the job application form for a specific job
Route::get('/jobs/{job}/apply', [JobController::class, 'applyForm'])->name('jobs.apply');

// Route to handle the form submission
Route::post('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply.submit');

// Applicant Dashboard Route
Route::get('/applicant/dashboard', [ApplicantDashboardController::class, 'index'])->name('applicant.dashboard');

Route::post('/applications/{application}/update-status', [JobController::class, 'updateStatus'])->name('application.updateStatus');

require __DIR__.'/auth.php';
