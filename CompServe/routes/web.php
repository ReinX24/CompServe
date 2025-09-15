<?php

use App\Http\Controllers\Freelancer\FreelancerInformationController;
use App\Http\Controllers\Client\ClientInformationController;
use App\Http\Controllers\Client\ClientJobListingController;
use App\Http\Controllers\Freelancer\FreelancerJobListingController;
use App\Http\Controllers\Settings;
use App\Models\JobApplication;
use App\Models\JobListing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('test');
});

Route::get('/', function () {
    // return view('welcome');
    return view('landing');
})->name('home');

Route::get('/dashboard', function () {
    // Redirect the user to the appropriate dashboard
    if (Auth::user()->role === "freelancer") {
        return view('freelancer.dashboard');
    } elseif (Auth::user()->role === "client") {
        return view('client.dashboard');
    } else {
        return view('dashboard');
    }
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
});

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
        Route::post('/', [FreelancerJobListingController::class, 'applyForJob'])->name('jobs.apply');
        Route::get('/available', [FreelancerJobListingController::class, 'availableJobs'])->name('jobs.available');
        Route::get('/applied', [FreelancerJobListingController::class, 'appliedJobs'])->name('jobs.applied');
        Route::get('/current', [FreelancerJobListingController::class, 'currentJobs'])->name('jobs.current');
        Route::get('/rejected', [FreelancerJobListingController::class, 'rejectedJobs'])->name('jobs.rejected');
        Route::get('/finished', [FreelancerJobListingController::class, 'completedJobs'])->name('jobs.finished');

        Route::get('/{jobListing}', [FreelancerJobListingController::class, 'show'])->name('jobs.show');
    });

    // Profile of the freelancer
    Route::prefix('profile')->group(function () {
        // Show current profile
        Route::get('/', [FreelancerInformationController::class, 'show'])->name('profile.show');
        Route::get('/edit', [FreelancerInformationController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [FreelancerInformationController::class, 'update'])->name('profile.update');
    });
});

// Client routes
Route::prefix('client')->middleware('auth')->name('client.')->group(function () {
    Route::get('/dashboard', function () {
        // TODO: show posted jobs count, in progress jobs, and completed jobs
        $postedCount = JobListing::where([['client_id', Auth::user()->id], ['status', 'open']])->count();
        $inProgressCount = JobListing::where([['client_id', Auth::user()->id], ['status', 'in_progress']])->count();
        $completedCount = JobListing::where([['client_id', Auth::user()->id], ['status', 'completed']])->count();

        return view('client.dashboard', compact('postedCount', 'inProgressCount', 'completedCount'));
    })->name('dashboard');

    Route::prefix('jobs')->group(function () {
        Route::get('/', [ClientJobListingController::class, 'index'])->name('jobs.index');

        Route::get('/create', [ClientJobListingController::class, 'create'])->name('jobs.create');
        Route::post('/', [ClientJobListingController::class, 'store'])->name('jobs.store');

        Route::get('/posted', [ClientJobListingController::class, 'postedJobs'])->name('jobs.posts');
        Route::get('/in_progress', [ClientJobListingController::class, 'inProgressJobs'])->name('jobs.in_progress');
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

// TODO: admin routes

require __DIR__ . '/auth.php';
