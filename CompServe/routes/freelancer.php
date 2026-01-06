<?php

use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\Freelancer\FreelancerReviewController;
use App\Http\Controllers\GigController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\JobListing;
use App\Models\JobApplication;
use App\Http\Controllers\Freelancer\FreelancerJobListingController;
use App\Http\Controllers\Freelancer\FreelancerInformationController;

// Freelancer routes
Route::prefix('freelancer')
    ->middleware('freelancer')
    ->name('freelancer.')
    ->group(function () {
        Route::get('/dashboard', function () {
            $user = Auth::user();

            // Available Gigs
            $availableGigsCount = JobListing::where([
                ['status', 'open'],
                ['duration_type', 'gig']
            ])->count();

            // Available Contracts
            $availableContractsCount = JobListing::where([
                ['status', 'open'],
                ['duration_type', 'contract']
            ])->count();

            // Applied Gigs
            $appliedGigsCount = JobApplication::with('job')
                ->where([
                    ['freelancer_id', $user->id],
                    ['status', 'pending']
                ])
                ->whereHas('job', function ($query) {
                $query->where('duration_type', 'gig');
            })
                ->count();

            // Applied Contracts
            $appliedContractsCount = JobApplication::with('job')
                ->where([
                    ['freelancer_id', $user->id],
                    ['status', 'pending']
                ])
                ->whereHas('job', function ($query) {
                $query->where('duration_type', 'contract');
            })
                ->count();

            // Current Gigs
            $currentGigsCount = JobApplication::with('job')
                ->where([
                    ['freelancer_id', $user->id],
                    ['status', 'accepted']
                ])
                ->whereHas('job', function ($query) {
                $query->where('duration_type', 'gig');
            })
                ->count();

            // Current Contracts
            $currentContractsCount = JobApplication::with('job')
                ->where([
                    ['freelancer_id', $user->id],
                    ['status', 'accepted']
                ])
                ->whereHas('job', function ($query) {
                $query->where('duration_type', 'contract');
            })
                ->count();

            // Completed Gigs
            $completedGigsCount = JobApplication::with('job')
                ->where([
                    ['freelancer_id', $user->id],
                    ['status', 'completed']
                ])
                ->whereHas('job', function ($query) {
                $query->where('duration_type', 'gig');
            })
                ->count();

            // Completed Contracts
            $completedContractsCount = JobApplication::with('job')
                ->where([
                    ['freelancer_id', $user->id],
                    ['status', 'completed']
                ])
                ->whereHas('job', function ($query) {
                $query->where('duration_type', 'contract');
            })
                ->count();

            return view('freelancer.dashboard', compact(
                'availableGigsCount',
                'availableContractsCount',
                'appliedGigsCount',
                'appliedContractsCount',
                'currentGigsCount',
                'currentContractsCount',
                'completedGigsCount',
                'completedContractsCount'
            ));
        })->name('dashboard');

        Route::prefix('jobs')->group(function () {
            Route::get('/{jobListing}/', [
                FreelancerJobListingController::class,
                'show'
            ])->name('jobs.show');

            Route::post('/{jobListing}/apply', [
                FreelancerJobListingController::class,
                'applyForJob'
            ])->name('jobs.apply');

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

            // Reset password
            Route::post('/change-password', [FreelancerInformationController::class, 'changePassword'])->name('profile.changePassword');
        });

        Route::get('/reviews', [FreelancerReviewController::class, 'index'])->name('reviews');

        // Gig routes
        Route::prefix('gigs')->group(function () {
            Route::get(
                '/index',
                [GigController::class, 'gigsIndex']
            )->name('gigs.index');

            Route::get(
                '/open',
                [GigController::class, 'openGigJobs']
            )->name('gigs.open');

            Route::get('/applied', [
                GigController::class,
                'appliedOpenGigJobs'
            ])->name('gigs.applied');

            Route::get(
                '/in_progress',
                [GigController::class, 'inProgressGigJobs']
            )->name('gigs.in_progress');

            Route::get(
                '/rejected',
                [GigController::class, 'rejectedGigJobs']
            )->name('gigs.rejected');

            Route::get(
                '/cancelled',
                [GigController::class, 'cancelledGigJobs']
            )->name('gigs.cancelled');

            Route::get('/completed', [
                GigController::class,
                'completedGigJobs'
            ])->name('gigs.completed');
        });

        // Contract routes
        Route::prefix('contracts')->group(function () {
            Route::get('/index', [
                ContractController::class,
                'contractsIndex'
            ])->name('contracts.index');

            Route::get('/open', [
                ContractController::class,
                'openContractJobs'
            ])->name('contracts.open');

            Route::get('/applied', [
                ContractController::class,
                'appliedOpenContractJobs'
            ])->name('contracts.applied');

            Route::get('/in_progress', [
                ContractController::class,
                'inProgressContractJobs'
            ])->name('contracts.in_progress');

            Route::get('/rejected', [
                ContractController::class,
                'rejectedContractJobs'
            ])->name('contracts.rejected');

            Route::get('/cancelled', [
                ContractController::class,
                'cancelledContractJobs'
            ])->name('contracts.cancelled');

            Route::get(
                '/finished',
                [ContractController::class, 'completedContractJobs']
            )->name('contracts.completed');
        });
    });

Route::middleware('freelancer')->group(function () {
    Route::get('/freelancer/certifications', [
        CertificationController::class,
        'index'
    ])->name('freelancer.certifications.index');

    Route::get('/freelancer/certifications/create', [
        CertificationController::class,
        'create'
    ])->name('freelancer.certifications.create');

    Route::delete(
        '/freelancer/certifications/{certification}',
        [
            CertificationController::class,
            'destroy'
        ]
    )->name('certifications.destroy');

    Route::post('/freelancer/certifications/store', [
        CertificationController::class,
        'store'
    ])->name('freelancer.certifications.store');
});
