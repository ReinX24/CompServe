<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JobListing;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function loginPage()
    {
        return view('auth.admin.login');
    }

    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // Ensure the user is actually an admin
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back, Admin!');
            }

            // If not an admin, immediately log them out and reject
            Auth::logout();
            return back()->withErrors([
                'email' => 'Access denied. You are not an admin.',
            ]);
        }

        // Failed login attempt
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        $usersCount = User::count();

        // TODO: add cards for jobcount and reviews count
        $jobsCount = JobListing::count();
        $reviewsCount = Review::count();

        return view('admin.dashboard', compact('usersCount', 'jobsCount', 'reviewsCount'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,freelancer,client',
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'User information updated successfully.');
    }

    public function deleteUser(User $user)
    {
        // prevent deleting own admin account (optional)
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function resetPassword(User $user)
    {
        $newPassword = 'password123'; // or Str::random(10)

        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        // TODO: send an email whenever the password is reset
        // $user->notify(new PasswordResetNotification($newPassword));

        return redirect()->back()->with('success', "Password reset successfully. New password: $newPassword");
    }

    public function jobs()
    {
        $jobs = JobListing::all();
        return view('admin.jobs', compact('jobs'));
    }

    public function updateJob(Request $request, JobListing $job)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
        ]);

        $job->update($validated);
        return back()->with('success', 'Job updated successfully.');
    }

    public function deleteJob(JobListing $job)
    {
        $job->delete();
        return back()->with('success', 'Job deleted successfully.');
    }

    public function reviews()
    {
        $reviews = Review::with(['freelancer', 'jobListing'])->latest()->get();
        return view('admin.reviews', compact('reviews'));
    }
}
