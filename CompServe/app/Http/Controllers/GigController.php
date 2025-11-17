<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Auth;
use Illuminate\Http\Request;

class GigController extends Controller
{
    /**
     * Fetch gigs depending on user role.
     */
    private function fetchGigsForRole($status = null, $filters = [])
    {
        // If user is a client → only show THEIR gigs
        if (Auth::user()->role === "client") {
            $query = Auth::user()
                ->jobListings()
                ->where('duration_type', 'gig');
        }

        // If user is a freelancer → show ALL client-posted gigs
        else {
            $query = JobListing::query()
                ->where('duration_type', 'gig')
                ->whereHas('client'); // ensures it belongs to a client
        }

        // Apply status filter (open, completed, etc.)
        if ($status) {
            $query->where('status', $status);
        }

        // Apply search filters (category, search, location, etc.)
        return $query->filter($filters)->latest();
    }

    /**
     * All Gigs Page
     */
    public function gigsIndex(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location', 'status']);

        $jobs = $this->fetchGigsForRole(null, $filters)->get();

        return view('gigs.all-gigs', compact('jobs'));
    }

    /**
     * Open Gigs Page
     */
    public function openGigJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        $jobs = $this->fetchGigsForRole('open', $filters)->paginate(6);

        return view('gigs.open-gigs', compact('jobs'));
    }

    /**
     * In-Progress Gigs Page
     */
    public function inProgressGigJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        if (Auth::user()->role === 'client') {
            $jobs = Auth::user()
                ->jobListings()
                ->where('status', 'in_progress')
                ->where('duration_type', 'gig')
                ->filter($filters)
                ->paginate(6);
        } else {
            $jobs = JobListing::where('status', 'in_progress')
                ->where('duration_type', 'gig')
                ->whereHas('applications', function ($query) {
                    $query->where('freelancer_id', Auth::id())
                        ->where('status', 'accepted');
                })
                ->filter($filters)
                ->paginate(6);
        }

        return view('gigs.in-progress-gigs', compact('jobs'));
    }

    public function rejectedGigJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        $jobs = JobListing::where('duration_type', 'gig')
            ->whereHas('applications', function ($query) {
                $query->where('freelancer_id', Auth::id())
                    ->where('status', 'rejected');
            })
            ->filter($filters)
            ->paginate(6);

        return view('gigs.rejected-gigs', compact('jobs'));
    }

    /**
     * Cancelled Gigs Page
     */
    public function cancelledGigJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        if (Auth::user()->role === 'client') {
            $jobs = Auth::user()
                ->jobListings()
                ->where('status', 'cancelled')
                ->where('duration_type', 'gig')
                ->filter($filters)
                ->paginate(6);
        } else {
            $jobs = JobListing
                ::where('status', 'cancelled')
                ::where('duration_type', 'gig')
                ->whereHas('applications', function ($query) {
                    $query->where('freelancer_id', Auth::id())
                        ->where('status', 'cancelled');
                })
                ->filter($filters)
                ->paginate(6);
        }

        return view('gigs.cancelled-gigs', compact('jobs'));
    }

    /**
     * Completed Gigs Page
     */
    public function completedGigJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        if (Auth::user()->role === 'client') {
            $jobs = Auth::user()
                ->jobListings()
                ->where('status', 'completed')
                ->where('duration_type', 'gig')
                ->filter($filters)
                ->paginate(6);
        } else {
            $jobs = JobListing::where('duration_type', 'gig')
                ->whereHas('applications', function ($query) {
                    $query->where('freelancer_id', Auth::id())
                        ->where('status', 'accepted');
                })
                ->filter($filters)
                ->paginate(6);
        }

        return view('gigs.completed-gigs', compact('jobs'));
    }
}
