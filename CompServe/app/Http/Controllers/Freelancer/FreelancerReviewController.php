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
        // Getting all the reviews related to the current freelancer
        $reviews = Review::with('jobListing')->where('freelancer_id', $freelancer->id)->get();
        // Getting the average rating of the reviews
        $averageRating = $reviews->avg('rating');

        return view('freelancer.reviews', compact('reviews', 'averageRating'));
    }
}
