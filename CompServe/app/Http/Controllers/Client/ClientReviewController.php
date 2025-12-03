<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Auth;
use Illuminate\Http\Request;

class ClientReviewController extends Controller
{
    // Show and edit the reviews of the current user client
    public function reviews(Request $request)
    {
        $query = Review::where('client_id', Auth::id());

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereHas('freelancer', function ($u) use ($search) {
                    $u->where('name', 'LIKE', "%{$search}%");
                })
                    ->orWhereHas('jobListing', function ($j) use ($search) {
                        $j->where('title', 'LIKE', "%{$search}%");
                    })
                    ->orWhere('comments', 'LIKE', "%{$search}%");
            });
        }

        // Filter: show only X-star reviews (1,2,3,4,5)
        if ($request->filled('stars_exact')) {
            $query->where('rating', $request->stars_exact);
        }

        // Sort: show X stars and above
        if ($request->filled('stars_min')) {
            $query->where('rating', '>=', $request->stars_min);
        }

        // Pagination
        $reviews = $query->latest()->paginate(6)->appends($request->query());

        return view('client.reviews.all-reviews', compact('reviews'));
    }

    public function showReviews()
    {
        // TODO: show singular review
    }

    public function editReviews()
    {
        // TODO: edit review after creating them
    }
}
