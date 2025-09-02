<?php

use App\Http\Controllers\FreelancerProfileController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
        return view('freelancer.dashboard');
    })->name('dashboard');

    Route::get('/jobs/available', function () {
        return view('freelancer.jobs.available-jobs');
    })->name('jobs.available');

    Route::get('/jobs/applied', function () {
        return view('freelancer.jobs.applied-jobs');
    })->name('jobs.applied');

    Route::get('/jobs/current', function () {
        return view('freelancer.jobs.current-jobs');
    })->name('jobs.current');

    Route::get('/jobs/finished', function () {
        return view('freelancer.jobs.finished-jobs');
    })->name('jobs.finished');

    // Profile of the freelancer
    Route::prefix('profile')->group(function () {
        Route::get('/', [FreelancerProfileController::class, 'show'])->name('profile.show');
        Route::get('/edit', [FreelancerProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [FreelancerProfileController::class, 'update'])->name('profile.update');
    });
});

// Client routes
Route::prefix('client')->middleware('auth')->name('client.')->group(function () {
    Route::get('/dashboard', function () {
        return view('client.dashboard');
    })->name('dashboard');

    Route::prefix('jobs')->group(function () {
        Route::get('/', [JobListingController::class, 'postedJobs'])->name('jobs.posts');

        Route::get('/create', [JobListingController::class, 'create'])->name('jobs.create');
        Route::post('/', [JobListingController::class, 'store'])->name('jobs.store');

        Route::get('/in_progress', [JobListingController::class, 'inProgressJobs'])->name('jobs.in_progress');

        Route::get('/finished', [JobListingController::class, 'completedJobs'])->name('jobs.completed');

        Route::get('/{jobListing}/', [JobListingController::class, 'show'])->name('jobs.show');
        Route::get('/{jobListing}/edit', [JobListingController::class, 'edit'])->name('jobs.edit');


    });
});

// TODO: admin routes

require __DIR__ . '/auth.php';
