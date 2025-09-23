<?php

// use App\Http\Controllers\Freelancer\FreelancerInformationController;
// use App\Http\Controllers\Client\ClientInformationController;
// use App\Http\Controllers\Client\ClientJobListingController;
// use App\Http\Controllers\Freelancer\FreelancerJobListingController;
// use App\Http\Controllers\Settings;
// use App\Models\JobApplication;
// use App\Models\JobListing;
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
        // return view('freelancer.dashboard');
        return redirect()->route("freelancer.dashboard");
    } elseif (Auth::user()->role === "client") {
        // return view('client.dashboard');
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

// TODO: admin routes

require __DIR__ . '/auth.php';
