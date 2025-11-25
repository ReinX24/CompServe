<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Auth;
use Illuminate\Http\Request;

class FreelancerReviewController extends Controller
{
    public function index()
    {
        $freelancer = Auth::user();

        // Paginate reviews (5 per page for example)
        $reviews = Review::with(['jobListing', 'client', 'freelancer'])
            ->where('freelancer_id', $freelancer->id)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        // Average rating for all reviews (not just current page)
        $averageRating = Review::where('freelancer_id', $freelancer->id)
            ->avg('rating');

        return view('freelancer.all-reviews', compact('reviews', 'averageRating'));
    }
}
