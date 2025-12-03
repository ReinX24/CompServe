<?php

use App\Events\MyEvent;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Client\ClientProfileController;
use App\Http\Controllers\Freelancer\FreelancerInformationController;
use App\Http\Controllers\UserSearchController;
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
require __DIR__ . '/admin.php';

// Auth routes
require __DIR__ . '/auth.php';

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
    Route::get('/chat', [ChatController::class, 'conversations'])->name('chat.dashboard');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    Route::get('/chat/{userId}', [ChatController::class, 'showChat'])->name('chat.show');
    Route::get('/chat', [ChatController::class, 'dashboard'])->name('chat.dashboard');
    Route::post('/chat/read', [ChatController::class, 'markAsRead']);
    Route::get('/users/search', [UserSearchController::class, 'search']);
});

Route::get('/client/{userId}', [ClientProfileController::class, 'showPublic'])
    ->name('client.profile');

Route::get('/freelancer/{user}', [FreelancerInformationController::class, 'showPublic'])
    ->name('freelancer.profile');