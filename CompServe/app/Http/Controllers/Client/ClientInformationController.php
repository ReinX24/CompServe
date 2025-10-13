<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Auth;
use Illuminate\Http\Request;

class ClientInformationController extends Controller
{
    public function show()
    {
        return view('client.profile-show');
    }

    public function edit()
    {

    }

    public function update()
    {

    }

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

    }

    public function editReviews()
    {

    }
}
