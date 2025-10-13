<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientProfile;
use Auth;
use Hash;
use Illuminate\Http\Request;

class ClientProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->clientProfile;

        return view('client.profile-show', compact('user', 'profile'));
    }

    public function edit()
    {
        $profile = Auth::user()->clientProfile;
        return view('client.profile-edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'bio' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        $profile = Auth::user()->clientProfile;
        if (!$profile) {
            $profile = new ClientProfile(['user_id' => Auth::id()]);
        }

        $profile->fill($validated);
        $profile->save();

        return redirect()->route('client.profile.show')->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Your current password is incorrect.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password changed successfully!');
    }
}
