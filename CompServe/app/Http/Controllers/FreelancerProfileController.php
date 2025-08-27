<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelancerProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $freelancerInfo = $user->freelancerInformation;

        return view('freelancer.profile-show', compact('user', 'freelancerInfo'));
    }

    public function edit()
    {
        $user = Auth::user();

        // Get freelancer information (ensure relation is defined in User model)
        $freelancerInfo = $user->freelancerInformation;

        return view('freelancer.profile-edit', compact('user', 'freelancerInfo'));
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // Current logged-in freelancer

        // Validate form inputs
        $validated = $request->validate([
            'contact_number' => ['nullable', 'string', 'max:20'],  // make sure column name matches migration
            'about_me' => ['nullable', 'string', 'max:1000'],
        ]);

        $user->freelancerInformation()->update($validated);

        return redirect()->route('freelancer.profile.show')
            ->with('success', 'Profile updated successfully.');
    }
}
