<?php

use App\Http\Controllers\Client\ClientInformationController;
use App\Http\Controllers\Client\ClientJobListingController;
use App\Models\JobApplication;
use App\Models\JobListing;

// Client routes
Route::prefix('client')
    ->middleware('auth')->name('client.')
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
            )->count();

            return view('client.dashboard', compact('postedCount', 'inProgressCount', 'completedCount', 'applicationCount'));
        })->name('dashboard');

        Route::prefix('jobs')->group(function () {
            Route::get('/', [ClientJobListingController::class, 'index'])->name('jobs.index');

            Route::get('/create', [ClientJobListingController::class, 'create'])->name('jobs.create');
            Route::post('/', [ClientJobListingController::class, 'store'])->name('jobs.store');

            Route::get('/posted', [ClientJobListingController::class, 'postedJobs'])->name('jobs.posts');
            Route::get('/in_progress', [ClientJobListingController::class, 'inProgressJobs'])->name('jobs.in_progress');
            Route::get('/cancelled', [ClientJobListingController::class, 'cancelledJobs'])->name('jobs.cancelled');
            Route::get('/finished', [ClientJobListingController::class, 'completedJobs'])->name('jobs.completed');

            Route::get('/{jobListing}/', [ClientJobListingController::class, 'show'])->name('jobs.show');
            Route::get('/{jobListing}/edit', [ClientJobListingController::class, 'edit'])->name('jobs.edit');
            Route::put('/{jobListing}/update', [ClientJobListingController::class, 'update'])->name('jobs.update');
            Route::delete('/{jobListing}/destroy', [ClientJobListingController::class, 'destroy'])->name('jobs.destroy');

            Route::get('/{jobListing}/applicants', [ClientJobListingController::class, 'allApplicants'])->name('jobs.applicants');
            Route::get('/{jobListing}/applicant/{user}', [ClientJobListingController::class, 'showApplicant'])->name('jobs.applicant');

            Route::put('/{application}/accept', [ClientJobListingController::class, 'acceptApplicant'])->name('jobs.applicant.accept');
            Route::put('/{jobListing}/complete', [ClientJobListingController::class, 'markJobAsComplete'])->name('jobs.complete');
            Route::put('/{jobListing}/cancel', [ClientJobListingController::class, 'markJobAsCancelled'])->name('jobs.cancel');
        });

        // Profile of the client
        Route::prefix('profile')->group(function () {
            Route::get('/', [ClientInformationController::class, 'show'])->name('profile.show');
            Route::get('/edit', [ClientInformationController::class, 'edit'])->name('profile.edit');
            Route::put('/update', [ClientInformationController::class, 'update'])->name('profile.update');
        });
    });