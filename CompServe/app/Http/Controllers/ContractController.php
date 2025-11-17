<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Auth;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Fetch contracts depending on user role.
     */
    private function fetchContractsForRole($status = null, $filters = [])
    {
        // If user is a client → only show THEIR contracts
        if (Auth::user()->role === "client") {
            $query = Auth::user()
                ->jobListings()
                ->where('duration_type', 'contract');
        }

        // If user is a freelancer → show ALL contracts posted by clients
        else {
            $query = JobListing::query()
                ->where('duration_type', 'contract')
                ->whereHas('client'); // ensure it belongs to a client
        }

        // Filter by status (open, completed, etc.)
        if ($status) {
            $query->where('status', $status);
        }

        return $query->filter($filters)->latest();
    }

    /**
     * All Contracts Page
     */
    public function contractsIndex(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location', 'status']);

        $jobs = $this->fetchContractsForRole(null, $filters)->get();

        return view('contracts.all-contracts', compact('jobs'));
    }

    /**
     * Open Contracts Page
     */
    public function openContractJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        $jobs = $this->fetchContractsForRole('open', $filters)->paginate(6);

        return view('contracts.open-contracts', compact('jobs'));
    }

    /**
     * In-Progress Contracts Page
     */
    public function inProgressContractJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        if (Auth::user()->role === 'client') {
            // Client: contracts they posted
            $jobs = Auth::user()
                ->jobListings()
                ->where('status', 'in_progress')
                ->where('duration_type', 'contract')
                ->filter($filters)
                ->paginate(6);
        } else {
            // Freelancer: contracts where they got accepted
            $jobs = JobListing::where('status', 'in_progress')
                ->where('duration_type', 'contract')
                ->whereHas('applications', function ($q) {
                    $q->where('freelancer_id', Auth::id())
                        ->where('status', 'accepted');
                })
                ->filter($filters)
                ->paginate(6);
        }

        return view('contracts.in-progress-contracts', compact('jobs'));
    }

    /**
     * Rejected Contracts Page
     */
    public function rejectedContractJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        $jobs = JobListing::where('duration_type', 'contract')
            ->whereHas('applications', function ($q) {
                $q->where('freelancer_id', Auth::id())
                    ->where('status', 'rejected');
            })
            ->filter($filters)
            ->paginate(6);

        return view('contracts.rejected-contracts', compact('jobs'));
    }

    /**
     * Cancelled Contracts Page
     */
    public function cancelledContractJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        if (Auth::user()->role === 'client') {
            // Client: their cancelled jobs
            $jobs = Auth::user()
                ->jobListings()
                ->where('status', 'cancelled')
                ->where('duration_type', 'contract')
                ->filter($filters)
                ->paginate(6);
        } else {
            // Freelancer: cancelled jobs they were accepted into
            $jobs = JobListing::where('status', 'cancelled')
                ->where('duration_type', 'contract')
                ->whereHas('applications', function ($q) {
                    $q->where('freelancer_id', Auth::id())
                        ->where('status', 'cancelled');
                })
                ->filter($filters)
                ->paginate(6);
        }

        return view('contracts.cancelled-contracts', compact('jobs'));
    }

    /**
     * Completed Contracts Page
     */
    public function completedContractJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        if (Auth::user()->role === 'client') {
            $jobs = Auth::user()
                ->jobListings()
                ->where('status', 'completed')
                ->where('duration_type', 'contract')
                ->filter($filters)
                ->paginate(6);
        } else {
            $jobs = JobListing::where('status', 'completed')
                ->where('duration_type', 'contract')
                ->whereHas('applications', function ($q) {
                    $q->where('freelancer_id', Auth::id())
                        ->where('status', 'accepted');
                })
                ->filter($filters)
                ->paginate(6);
        }

        return view('contracts.completed-contracts', compact('jobs'));
    }
}
