<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $user->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'location_updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Location shared successfully'
        ]);
    }

    public function disableLocation()
    {
        $user = auth()->user();

        $user->update([
            'latitude' => null,
            'longitude' => null,
            'location_updated_at' => null,
        ]);

        return response()->json([
            'message' => 'Location disabled'
        ]);
    }
}
