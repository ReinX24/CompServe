<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FindFreelancerController extends Controller
{
    public function index(Request $request)
    {
        $client = $request->user();

        // Only clients allowed
        if ($client->role !== 'client') {
            abort(403);
        }

        // Client must have location
        if (!$client->latitude || !$client->longitude) {
            return view('client.find-freelancers', [
                'freelancers' => collect(),
                'error' => 'Please enable location to find nearby freelancers.'
            ]);
        }

        $radius = $request->get('radius', 20); // km

        $freelancers = User::where('role', 'freelancer')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->selectRaw("
                users.*,
                (6371 * acos(
                    cos(radians(?)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) *
                    sin(radians(latitude))
                )) AS distance
            ", [$client->latitude, $client->longitude, $client->latitude])
            ->having('distance', '<=', $radius)
            ->orderBy('distance')
            ->get();

        return view('client.find-freelancers', compact('freelancers'));
    }
}
