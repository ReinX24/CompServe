<?php

use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
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
    Route::get('/profile', function () {
        return view('freelancer.profile');
    })->name('profile');
});

Route::prefix('client')->middleware('auth')->name('client.')->group(function () {
    Route::get('/dashboard', function () {
        return view('client.dashboard');
    })->name('dashboard');
});

Route::get('client/dashboard', function () {
    return view('client.dashboard');
})->middleware('auth')->name('client.dashboard');

require __DIR__ . '/auth.php';
