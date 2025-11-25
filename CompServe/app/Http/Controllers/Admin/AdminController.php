<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetNotificationMail;
use App\Models\Certification;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JobListing;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;
use Mail;
use Str;

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

    public function dashboard(Request $request)
    {
        $usersCount = User::count();
        $jobsCount = JobListing::count();
        $reviewsCount = Review::count();

        // Count pending certifications
        $pendingCertificationsCount = Certification::where('status', 'pending')->count();

        // Get filter type (default = monthly)
        $filterJobs = $request->input('filter_jobs', 'monthly');
        $filterUsers = $request->input('filter_users', 'monthly');

        // Jobs chart data
        $jobQuery = JobListing::query();
        switch ($filterJobs) {
            case 'daily':
                $jobChartData = $jobQuery->selectRaw('DATE(created_at) as label, COUNT(*) as count')
                    ->groupBy('label')->orderBy('label')->get();
                break;
            case 'weekly':
                $jobChartData = $jobQuery->selectRaw('YEARWEEK(created_at, 1) as label, COUNT(*) as count')
                    ->groupBy('label')->orderBy('label')->get();
                break;
            case 'yearly':
                $jobChartData = $jobQuery->selectRaw('YEAR(created_at) as label, COUNT(*) as count')
                    ->groupBy('label')->orderBy('label')->get();
                break;
            default: // monthly
                $jobChartData = $jobQuery->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as label, COUNT(*) as count')
                    ->groupBy('label')->orderBy('label')->get();
                break;
        }

        // Users chart data
        $userQuery = User::query();
        switch ($filterUsers) {
            case 'daily':
                $userChartData = $userQuery->selectRaw('DATE(created_at) as label, COUNT(*) as count')
                    ->groupBy('label')->orderBy('label')->get();
                break;
            case 'weekly':
                $userChartData = $userQuery->selectRaw('YEARWEEK(created_at, 1) as label, COUNT(*) as count')
                    ->groupBy('label')->orderBy('label')->get();
                break;
            case 'yearly':
                $userChartData = $userQuery->selectRaw('YEAR(created_at) as label, COUNT(*) as count')
                    ->groupBy('label')->orderBy('label')->get();
                break;
            default: // monthly
                $userChartData = $userQuery->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as label, COUNT(*) as count')
                    ->groupBy('label')->orderBy('label')->get();
                break;
        }

        return view('admin.dashboard', compact(
            'usersCount',
            'jobsCount',
            'reviewsCount',
            'pendingCertificationsCount',
            'jobChartData',
            'userChartData',
            'filterJobs',
            'filterUsers'
        ));
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
        $newPassword = Str::random(10);

        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        // Send an email to the user whenever their password is reset
        Mail::to($user->email)->send(new
            PasswordResetNotificationMail($user, $newPassword));

        return redirect()->back()->with('success', "Password reset successfully. New password: $newPassword");
    }

    public function jobs()
    {
        $jobs = JobListing::with('client')->latest()->get();
        return view('admin.jobs', compact('jobs'));
    }

    public function updateJob(Request $request, JobListing $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:open,in_progress,cancelled,completed',
            'budget' => 'nullable|numeric|min:0',
        ]);

        $job->update($validated);

        return redirect()->route('admin.jobs')
            ->with('success', 'Job listing updated successfully!');
    }

    public function deleteJob(JobListing $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs')
            ->with('success', 'Job listing deleted successfully!');
    }

    public function reviews()
    {
        $reviews = Review::with(['freelancer', 'jobListing'])->latest()->get();
        return view('admin.reviews', compact('reviews'));
    }
}
