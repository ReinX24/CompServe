<?php

use App\Http\Controllers\Client\ClientReviewController;
use App\Http\Controllers\Client\ClientReviews;
use App\Http\Controllers\Client\ClientJobListingController;
use App\Http\Controllers\Client\ClientInformationController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\GigController;
use App\Models\JobApplication;
use App\Models\JobListing;

// Client routes
Route::prefix('client')
    // client middleware checks if the user is logged in and an admin account
    ->middleware('client')
    ->name('client.')
    ->group(function () {
        Route::get('/dashboard', function () {
            $postedCount = JobListing::where(
                [['client_id', Auth::user()->id], ['status', 'open']]
            )->count() ?? 0;

            $inProgressCount = JobListing::where(
                [['client_id', Auth::user()->id], ['status', 'in_progress']]
            )->count() ?? 0;

            $completedCount = JobListing::where(
                [['client_id', Auth::user()->id], ['status', 'completed']]
            )->count() ?? 0;

            // Amount of applications that the current client has
            $applicationCount = JobApplication::where(
                'client_id',
                Auth::user()->id
            )->count() ?? 0;

            return view('client.dashboard', compact(
                'postedCount',
                'inProgressCount',
                'completedCount',
                'applicationCount'
            ));
        })->name('dashboard');


        Route::prefix('jobs')->group(function () {
            Route::get('/', [ClientJobListingController::class, 'index'])->name('jobs.index');

            Route::get('/create', [ClientJobListingController::class, 'create'])->name('jobs.create');
            Route::post('/', [ClientJobListingController::class, 'store'])->name('jobs.store');

            // Route::get('/posted', [ClientJobListingController::class, 'postedJobs'])->name('jobs.posts');
            // Route::get('/in_progress', [ClientJobListingController::class, 'inProgressJobs'])->name('jobs.in_progress');
            // Route::get('/cancelled', [ClientJobListingController::class, 'cancelledJobs'])->name('jobs.cancelled');
            // Route::get('/finished', [ClientJobListingController::class, 'completedJobs'])->name('jobs.completed');

            Route::get('/{jobListing}/', [ClientJobListingController::class, 'show'])->name('jobs.show');
            // Only the freelancer can update the job listing
            Route::get('/{jobListing}/edit', [ClientJobListingController::class, 'edit'])->name('jobs.edit');
            Route::put('/{jobListing}/update', [ClientJobListingController::class, 'update'])->name('jobs.update');
            Route::delete('/{jobListing}/destroy', [ClientJobListingController::class, 'destroy'])->name('jobs.destroy');

            Route::get('/{jobListing}/applicants', [ClientJobListingController::class, 'allApplicants'])->name('jobs.applicants');
            Route::get('/{jobListing}/applicant/{user}', [ClientJobListingController::class, 'showApplicant'])->name('jobs.applicant');

            Route::put('/{application}/accept', [ClientJobListingController::class, 'acceptApplicant'])->name('jobs.applicant.accept');
            Route::put('/{application}/reject', [ClientJobListingController::class, 'rejectApplicant'])->name('jobs.applicant.reject');
            Route::put('/{jobListing}/complete', [ClientJobListingController::class, 'markJobAsComplete'])->name('jobs.complete');
            Route::put('/{jobListing}/cancel', [ClientJobListingController::class, 'markJobAsCancelled'])->name('jobs.cancel');
        });

        // Routes for reviews
        Route::get('/reviews', [ClientReviewController::class, 'reviews'])->name('reviews');

        // ClientProfile
        Route::get('/profile', [ClientInformationController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ClientInformationController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ClientInformationController::class, 'update'])->name('profile.update');

        // Routes for gigs
        Route::prefix('gigs')->group(function () {
            Route::get('/index', [
                GigController::class,
                'gigsIndex'
            ])->name('gigs.index');

            Route::get(
                '/open',
                [GigController::class, 'openGigJobs']
            )->name('gigs.open');

            Route::get(
                '/in_progress',
                [GigController::class, 'inProgressGigJobs']
            )->name('gigs.in_progress');

            Route::get(
                '/cancelled',
                [GigController::class, 'cancelledGigJobs']
            )->name('gigs.cancelled');

            Route::get(
                '/completed',
                [GigController::class, 'completedGigJobs']
            )->name('gigs.completed');
        });

        // Routes for contracts
        Route::prefix('contracts')->group(function () {
            Route::get('/index', [
                ContractController::class,
                'contractsIndex'
            ])->name('contracts.index');

            Route::get('/open', [
                ContractController::class,
                'openContractJobs'
            ])->name('contracts.open');

            Route::get('/in_progress', [
                ContractController::class,
                'inProgressContractJobs'
            ])->name('contracts.in_progress');

            Route::get('/cancelled', [
                ContractController::class,
                'cancelledContractJobs'
            ])->name('contracts.cancelled');

            Route::get(
                '/finished',
                [
                    ContractController::class,
                    'completedContractJobs'
                ]
            )->name('contracts.completed');
        });

        // Reset password
        Route::post('/profile/change-password', [ClientInformationController::class, 'changePassword'])->name('profile.changePassword');
    });
