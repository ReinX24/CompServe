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
        $query = Auth::user()->role === "client"
            ? Auth::user()->jobListings()->where('duration_type', 'gig')
            : JobListing::where('duration_type', 'gig')->whereHas('client');

        if ($status) {
            $query->where('status', $status);
        }

        return $query->filter($filters)->latest();
    }

    /**
     * All Gigs Page
     */
    public function gigsIndex(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location', 'status']);

        /** -----------------------------------
         * CLIENT VIEW
         * ----------------------------------*/
        if (Auth::user()->role === 'client') {
            $jobs = Auth::user()
                ->jobListings()
                ->where('duration_type', 'gig')
                ->filter($filters)
                ->latest()
                ->get();

            return view('gigs.all-gigs', compact('jobs'));
        }

        /** -----------------------------------
         * FREELANCER VIEW
         * ----------------------------------*/
        $jobs = collect()
            ->merge($this->queryOpenGigs($filters)->get())
            ->merge($this->queryInProgressGigs($filters)->get())
            ->merge($this->queryCancelledGigs($filters)->get())
            ->merge($this->queryCompletedGigs($filters)->get())
            ->merge($this->queryRejectedGigs($filters)->get()) // rejected belongs ONLY to freelancer
            ->unique('id')
            ->sortByDesc('created_at')
            ->values();

        return view('gigs.all-gigs', compact('jobs'));
    }

    /**
     * Individual category pages
     */
    public function openGigJobs(Request $request)
    {
        return $this->renderCategory('open', $request, 'gigs.open-gigs');
    }

    public function appliedOpenGigJobs(Request $request)
    {
        $filters = $request->only([
            'search',
            'category',
            'client',
            'location'
        ]);

        if (Auth::user()->role !== 'freelancer') {
            abort(403, 'Only freelancers can view applied gigs.');
        }

        $jobs = JobListing::where('duration_type', 'gig')
            ->where('status', 'open')
            ->whereHas('applications', function ($q) {
                $q->where('freelancer_id', Auth::id());
            })
            ->filter($filters)
            ->latest()
            ->paginate(6);

        return view('gigs.applied-gigs', compact('jobs'));
    }

    public function inProgressGigJobs(Request $request)
    {
        return $this->renderCategory('in_progress', $request, 'gigs.in-progress-gigs');
    }

    public function rejectedGigJobs(Request $request)
    {
        return $this->renderFreelancerOnly(
            $request,
            'rejected',
            'gigs.rejected-gigs'
        );
    }

    public function cancelledGigJobs(Request $request)
    {
        return $this->renderFreelancerOrClient(
            $request,
            'cancelled',
            'gigs.cancelled-gigs'
        );
    }

    public function completedGigJobs(Request $request)
    {
        return $this->renderFreelancerOrClient(
            $request,
            'completed',
            'gigs.completed-gigs'
        );
    }

    /**
     * Helper: Render gig pages for client/freelancer
     */
    private function renderCategory($status, Request $request, $view)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        $jobs = $this->fetchGigsForRole($status, $filters)
            ->paginate(6);

        return view($view, compact('jobs'));
    }

    private function renderFreelancerOnly(Request $request, $appStatus, $view)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        $jobs = JobListing::where('duration_type', 'gig')
            ->whereHas('applications', function ($q) use ($appStatus) {
                $q->where('freelancer_id', Auth::id())
                    ->where('status', $appStatus);
            })
            ->filter($filters)
            ->latest()
            ->paginate(6);

        return view($view, compact('jobs'));
    }

    private function renderFreelancerOrClient(Request $request, $status, $view)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        if (Auth::user()->role === 'client') {
            $jobs = Auth::user()
                ->jobListings()
                ->where('duration_type', 'gig')
                ->where('status', $status)
                ->filter($filters)
                ->latest()
                ->paginate(6);

            return view($view, compact('jobs'));
        }

        // FREELANCER
        $method = "query" . ucfirst($status) . "Gigs";

        $jobs = $this->{$method}($filters)
            ->paginate(6);

        return view($view, compact('jobs'));
    }

    /**
     * Query Helpers (Freelancer)
     */
    private function queryOpenGigs($filters)
    {
        return JobListing::where('duration_type', 'gig')
            ->where('status', 'open')
            ->filter($filters)
            ->latest();
    }

    private function queryInProgressGigs($filters)
    {
        return JobListing::where('duration_type', 'gig')
            ->where('status', 'in_progress')
            ->whereHas('applications', function ($q) {
                $q->where('freelancer_id', Auth::id())
                    ->where('status', 'accepted');
            })
            ->filter($filters)
            ->latest();
    }

    private function queryRejectedGigs($filters)
    {
        return JobListing::where('duration_type', 'gig')
            ->whereHas('applications', function ($q) {
                $q->where('freelancer_id', Auth::id())
                    ->where('status', 'rejected');
            })
            ->filter($filters)
            ->latest();
    }

    private function queryCancelledGigs($filters)
    {
        return JobListing::where('duration_type', 'gig')
            ->where('status', 'cancelled')
            ->whereHas('applications', function ($q) {
                $q->where('freelancer_id', Auth::id())
                    ->where('status', 'cancelled');
            })
            ->filter($filters)
            ->latest();
    }

    private function queryCompletedGigs($filters)
    {
        return JobListing::where('duration_type', 'gig')
            ->where('status', 'completed')
            ->whereHas('applications', function ($q) {
                $q->where('freelancer_id', Auth::id())
                    ->where('status', 'completed');
            })
            ->filter($filters)
            ->latest();
    }
}
