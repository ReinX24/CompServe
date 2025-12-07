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
        // If the user is a client, show all their own contract listings
        if (Auth::user()->role === "client") {
            $query = Auth::user()->jobListings()
                ->where('duration_type', 'contract');

            if ($status) {
                $query->where('status', $status);
            }

            return $query->filter($filters)->latest();
        }

        // If the user is a freelancer — filter by accepted applications
        $query = JobListing::where('duration_type', 'contract')
            ->whereHas('applications', function ($q) {
                $q->where('freelancer_id', Auth::id())
                    ->where('status', 'accepted'); // Only accepted contract applications
            });

        if ($status) {
            $query->where('status', $status); // Contract must still be in the specified status
        }

        return $query->filter($filters)->latest();
    }

    /**
     * All Contracts Page
     */
    public function contractsIndex(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location', 'status']);

        /** -----------------------------------
         * CLIENT VIEW
         * ----------------------------------*/
        if (Auth::user()->role === 'client') {
            $jobs = Auth::user()
                ->jobListings()
                ->where('duration_type', 'contract')
                ->filter($filters)
                ->latest()
                ->get();

            return view('contracts.all-contracts', compact('jobs'));
        }

        /** -----------------------------------
         * FREELANCER VIEW
         * ----------------------------------*/
        $jobs = collect()
            ->merge($this->queryOpenContracts($filters)->get())
            ->merge($this->queryInProgressContracts($filters)->get())
            ->merge($this->queryCancelledContracts($filters)->get())
            ->merge($this->queryCompletedContracts($filters)->get())
            ->merge($this->queryRejectedContracts($filters)->get()) // rejected belongs ONLY to freelancer
            ->unique('id')
            ->sortByDesc('created_at')
            ->values();

        return view('contracts.all-contracts', compact('jobs'));
    }

    /**
     * Individual category pages
     */
    public function openContractJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        // CLIENT VIEW - show their own open contracts
        if (Auth::user()->role === 'client') {
            $jobs = Auth::user()
                ->jobListings()
                ->where('duration_type', 'contract')
                ->where('status', 'open')
                ->filter($filters)
                ->latest()
                ->paginate(6);

            return view('contracts.open-contracts', compact('jobs'));
        }

        // FREELANCER VIEW - show open contracts they have NOT applied to
        $jobs = JobListing::where('duration_type', 'contract')
            ->where('status', 'open')
            ->whereDoesntHave('applications', function ($q) {
                $q->where('freelancer_id', Auth::id());
            })
            ->filter($filters)
            ->latest()
            ->paginate(6);

        return view('contracts.open-contracts', compact('jobs'));
    }

    public function appliedOpenContractJobs(Request $request)
    {
        $filters = $request->only([
            'search',
            'category',
            'client',
            'location'
        ]);

        if (Auth::user()->role !== 'freelancer') {
            abort(403, 'Only freelancers can view applied contracts.');
        }

        $jobs = JobListing::where('duration_type', 'contract')
            ->where('status', 'open') // Job listings must still be open
            ->whereHas('applications', function ($q) {
                $q->where('freelancer_id', Auth::id())
                    ->where('status', 'pending'); // Only pending applications
            })
            ->filter($filters)
            ->latest()
            ->paginate(6);

        return view('contracts.applied-contracts', compact('jobs'));
    }

    public function inProgressContractJobs(Request $request)
    {
        return $this->renderCategory('in_progress', $request, 'contracts.in-progress-contracts');
    }

    public function rejectedContractJobs(Request $request)
    {
        return $this->renderFreelancerOnly(
            $request,
            'rejected',
            'contracts.rejected-contracts'
        );
    }

    public function cancelledContractJobs(Request $request)
    {
        return $this->renderFreelancerOrClient(
            $request,
            'cancelled',
            'contracts.cancelled-contracts'
        );
    }

    public function completedContractJobs(Request $request)
    {
        return $this->renderFreelancerOrClient(
            $request,
            'completed',
            'contracts.completed-contracts'
        );
    }

    /**
     * Helper: Render contract pages for client/freelancer
     */
    private function renderCategory($status, Request $request, $view)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        $jobs = $this->fetchContractsForRole($status, $filters)
            ->paginate(6);

        return view($view, compact('jobs'));
    }

    private function renderFreelancerOnly(Request $request, $appStatus, $view)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        $jobs = JobListing::where('duration_type', 'contract')
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
                ->where('duration_type', 'contract')
                ->where('status', $status)
                ->filter($filters)
                ->latest()
                ->paginate(6);

            return view($view, compact('jobs'));
        }

        // FREELANCER
        $method = "query" . ucfirst($status) . "Contracts";

        $jobs = $this->{$method}($filters)
            ->paginate(6);

        return view($view, compact('jobs'));
    }

    /**
     * Query Helpers (Freelancer)
     */
    private function queryOpenContracts($filters)
    {
        // For "All Contracts" page - show open contracts NOT applied to
        return JobListing::where('duration_type', 'contract')
            ->where('status', 'open')
            ->whereDoesntHave('applications', function ($q) {
                $q->where('freelancer_id', Auth::id());
            })
            ->filter($filters)
            ->latest();
    }

    private function queryInProgressContracts($filters)
    {
        return JobListing::where('duration_type', 'contract')
            ->where('status', 'in_progress')
            ->whereHas('applications', function ($q) {
                $q->where('freelancer_id', Auth::id())
                    ->where('status', 'accepted');
            })
            ->filter($filters)
            ->latest();
    }

    private function queryRejectedContracts($filters)
    {
        return JobListing::where('duration_type', 'contract')
            ->whereHas('applications', function ($q) {
                $q->where('freelancer_id', Auth::id())
                    ->where('status', 'rejected');
            })
            ->filter($filters)
            ->latest();
    }

    private function queryCancelledContracts($filters)
    {
        return JobListing::where('duration_type', 'contract')
            ->where('status', 'cancelled')
            ->whereHas('applications', function ($q) {
                $q->where('freelancer_id', Auth::id())
                    ->where('status', 'cancelled');
            })
            ->filter($filters)
            ->latest();
    }

    private function queryCompletedContracts($filters)
    {
        return JobListing::where('duration_type', 'contract')
            ->where('status', 'completed')
            ->whereHas('applications', function ($q) {
                $q->where('freelancer_id', Auth::id())
                    ->where('status', 'completed');
            })
            ->filter($filters)
            ->latest();
    }
}