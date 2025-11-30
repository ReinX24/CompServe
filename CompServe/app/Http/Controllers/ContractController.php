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
        $query = Auth::user()->role === "client"
            ? Auth::user()->jobListings()->where('duration_type', 'contract')
            : JobListing::where('duration_type', 'contract')->whereHas('client');

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

        // CLIENT → simple return, only their jobs
        if (Auth::user()->role === 'client') {
            $jobs = Auth::user()
                ->jobListings()
                ->where('duration_type', 'contract')
                ->filter($filters)
                ->latest()
                ->get();

            return view('contracts.all-contracts', compact('jobs'));
        }

        // FREELANCER → merge all categories (just like gigs)
        $jobs = collect()
            ->merge($this->queryOpenContracts($filters)->get())
            ->merge($this->queryInProgressContracts($filters)->get())
            ->merge($this->queryCancelledContracts($filters)->get())
            ->merge($this->queryCompletedContracts($filters)->get())
            ->unique('id')
            ->sortByDesc('created_at')
            ->values();

        return view('contracts.all-contracts', compact('jobs'));
    }

    /**
     * Category Pages
     */
    public function openContractJobs(Request $request)
    {
        return $this->renderCategory('open', $request, 'contracts.open-contracts');
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
            ->where('status', 'open') // ⭐ Only OPEN contracts
            ->whereHas('applications', function ($q) {
                $q->where('freelancer_id', Auth::id()); // ⭐ User applied
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
     * Shared Render Helpers (exact copy from GigController)
     */
    private function renderCategory($status, Request $request, $view)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        $jobs = $this->fetchContractsForRole($status, $filters)->paginate(6);

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
                ->paginate(6);

            return view($view, compact('jobs'));
        }

        // Dynamically call queryCompletedContracts(), etc.
        $queryMethod = "query" . ucfirst($status) . "Contracts";
        $jobs = $this->{$queryMethod}($filters)->paginate(6);

        return view($view, compact('jobs'));
    }

    /**
     * Query Helpers (FREELANCER versions)
     */
    private function queryOpenContracts($filters)
    {
        return JobListing::where('duration_type', 'contract')
            ->where('status', 'open')
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
                    ->where('status', 'accepted');
            })
            ->filter($filters)
            ->latest();
    }
}
