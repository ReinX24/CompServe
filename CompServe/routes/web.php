<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\Client\ClientJobListingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('test');
});

Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/dashboard', function () {
    // Redirect the user to the appropriate dashboard
    if (Auth::user()->role === "freelancer") {
        return redirect()->route("freelancer.dashboard");
    } elseif (Auth::user()->role === "client") {
        return redirect()->route("client.dashboard");
    } else {
        return view('dashboard');
    }
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
//     Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
//     Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
//     Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
//     Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
//     Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
// });

require __DIR__ . '/freelancer.php';

require __DIR__ . '/client.php';


// Login admin
Route::get('/admin/login', [AdminController::class, 'loginPage'])->name('admin.login_page');
Route::post('/admin/login', [AdminController::class, 'loginAdmin'])->name('admin.login_admin');

// Admin routes
// TODO: migrate to a separate file
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/jobs', [AdminController::class, 'jobs'])->name('jobs');
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews');

    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::put('/users/{user}/reset-password', [AdminController::class, 'resetPassword'])->name('users.resetPassword');

    Route::put('/jobs/{job}', [AdminController::class, 'updateJob'])->name('jobs.update');
    Route::delete('/jobs/{job}', [AdminController::class, 'deleteJob'])->name('jobs.delete');
});

require __DIR__ . '/auth.php';

Route::middleware('freelancer')->group(function () {
    Route::get('/freelancer/certifications', [
        CertificationController::class,
        'index'
    ])->name('freelancer.certifications.index');

    Route::get('/freelancer/certifications/create', [
        CertificationController::class,
        'create'
    ])->name('freelancer.certifications.create');

    Route::post('/freelancer/certifications/store', [
        CertificationController::class,
        'store'
    ])->name('freelancer.certifications.store');
});
