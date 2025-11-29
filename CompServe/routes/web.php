<?php

use App\Events\MyEvent;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ChatController;
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
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/jobs', [AdminController::class, 'jobs'])->name('jobs');
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews');

    Route::get('/certifications', [CertificationController::class, 'index'])->name('certifications');
    Route::post('/certifications/{cert}/approve', [CertificationController::class, 'approve'])->name('certifications.approve');
    Route::post('/certifications/{cert}/reject', [CertificationController::class, 'reject'])->name('certifications.reject');

    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::put('/users/{user}/reset-password', [AdminController::class, 'resetPassword'])->name('users.resetPassword');

    Route::put('/jobs/{job}', [AdminController::class, 'updateJob'])->name('jobs.update');
    Route::delete('/jobs/{job}', [AdminController::class, 'deleteJob'])->name('jobs.delete');

    Route::get('/email-preview', function () {
        $user = \App\Models\User::first(); // Example user
        $newPassword = 'Temp1234!';        // Example password

        return view('emails.password_reset', compact('user', 'newPassword'));
    });
});

require __DIR__ . '/auth.php';

// TODO: approval and showing of certifications, simple messaging system

// Test route for broadcasting events
// Route::get('/trigger-my-event', function () {
//     broadcast(new MyEvent('Hello from Laravel!'));
//     return 'Event triggered!';
// });

// Test routes for chat messaging
// Route::get('/chat', function () {
//     return view('chat');
// });

// Route::post('/send-message', [ChatController::class, 'send']);

Route::middleware('auth')->group(function () {
    Route::post('/chat/send', [ChatController::class, 'send']);
    Route::get('/chat/{userId}', [ChatController::class, 'showChat']);
    // Route::get('/chat/messages/{userId}', [ChatController::class, 'fetchMessages']);
});

