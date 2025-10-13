<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Auth;
use Illuminate\Http\Request;

class ClientReviewController extends Controller
{
    // Show and edit the reviews of the current user client
    public function reviews()
    {
        // Get all the reviews of the current client user
        $reviews = Review::where(
            'client_id',
            Auth::user()->id
        )->latest()->paginate(6);

        // dd($reviews);
        return view(
            'client.reviews.all-reviews',
            compact('reviews')
        );
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
