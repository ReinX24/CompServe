<?php

use App\Events\MyEvent;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/jobs', [AdminController::class, 'jobs'])->name('jobs');
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews');

    Route::get('/certifications', [CertificationController::class, 'index'])->name('certifications');
    Route::post('/certifications/{cert}/approve', [CertificationController::class, 'approve'])->name('certifications.approve');
    Route::post('/certifications/{cert}/reject', [CertificationController::class, 'reject'])->name('certifications.reject');

    Route::post('/certifications/{id}/status', [CertificationController::class, 'updateStatus'])
        ->name('certifications.updateStatus');

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

Route::middleware('admin')->group(function () {
    // Regular user management
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

    // Trash management
    Route::get('/users/trash', [AdminController::class, 'indexOnlyTrashed'])->name('users.trash');
    Route::post('/users/{id}/restore', [AdminController::class, 'restoreUser'])->name('users.restore');
    Route::delete('/users/{id}/force-delete', [AdminController::class, 'forceDeleteUser'])->name('users.force-delete');
});