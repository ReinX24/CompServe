<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelancerProfileController extends Controller
{
    public function edit()
    {
        // Show edit form
        $user = Auth::user();

        return view('freelancer.profile-edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // Current logged-in freelancer

        // Validate form inputs
        $validated = $request->validate([
            'contact_number' => ['nullable', 'string', 'max:20'],
            'about_me' => ['nullable', 'string', 'max:1000'],
        ]);

        // Update user profile
        $user->update($validated);

        return redirect()->route('freelancer.profile')
            ->with('success', 'Profile updated successfully.');
    }
}
