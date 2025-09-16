<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\JobListing;
use App\Models\JobApplication;
use App\Http\Controllers\Freelancer\FreelancerJobListingController;
use App\Http\Controllers\Freelancer\FreelancerInformationController;

// Freelancer routes
Route::prefix('freelancer')->middleware('auth')->name('freelancer.')->group(function () {
    Route::get('/dashboard', function () {
        $availableJobsCount = JobListing::where('status', 'open')->count();

        $appliedJobsCount = JobApplication::with('job') // eager load job relationship
            ->where([
                ['freelancer_id', Auth::user()->id],
                ['status', 'pending']
            ])->count();

        $currentJobsCount = JobApplication::with('job')
            ->where('freelancer_id', Auth::user()->id)
            ->where('status', 'accepted')->count();

        $completedJobsCount = JobApplication::with('job')
            ->where('freelancer_id', Auth::user()->id)
            ->where('status', 'completed')
            ->count();

        return view('freelancer.dashboard', compact('availableJobsCount', 'appliedJobsCount', 'currentJobsCount', 'completedJobsCount'));
    })->name('dashboard');

    Route::prefix('jobs')->group(function () {
        Route::get('/', [FreelancerJobListingController::class, 'index'])->name('jobs.index');
        Route::get('/available', [FreelancerJobListingController::class, 'availableJobs'])->name('jobs.available');
        Route::get('/applied', [FreelancerJobListingController::class, 'appliedJobs'])->name('jobs.applied');
        Route::get('/current', [FreelancerJobListingController::class, 'currentJobs'])->name('jobs.current');
        Route::get('/rejected', [FreelancerJobListingController::class, 'rejectedJobs'])->name('jobs.rejected');
        Route::get('/finished', [FreelancerJobListingController::class, 'completedJobs'])->name('jobs.finished');

        Route::get('/{jobListing}', [FreelancerJobListingController::class, 'show'])->name('jobs.show');

        // TODO: move to a dedicated controller
        Route::post('/', [FreelancerJobListingController::class, 'applyForJob'])->name('jobs.apply');
        // Remove job application for current freelancer user
        Route::delete(
            '/{jobListing}/destroy',
            [FreelancerJobListingController::class, 'deleteJobApplication']
        )->name('jobs.removeApplication');
    });

    // Profile of the freelancer
    Route::prefix('profile')->group(function () {
        // Show current profile
        Route::get('/', [FreelancerInformationController::class, 'show'])->name('profile.show');
        Route::get('/edit', [FreelancerInformationController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [FreelancerInformationController::class, 'update'])->name('profile.update');
    });
});