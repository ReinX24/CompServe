<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientInformation;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class ClientInformationController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->clientProfile;

        return view('client.profile-show', compact('user', 'profile'));
    }

    public function showPublic($userId)
    {
        $user = User::with('clientProfile')->findOrFail($userId);

        // For cleaner template use:
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
            'about_me' => 'nullable|string',
            'contact_number' => 'nullable|string|max:20',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
        ]);

        $profile = Auth::user()->clientProfile;

        if (!$profile) {
            $profile = new ClientInformation(['user_id' => Auth::id()]);
        }

        $profile->fill($validated);
        $profile->save();

        return redirect()->route('client.profile.show')
            ->with('success', 'Profile updated successfully.');
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
