<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\JobListing;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function contractsIndex(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location', 'status']);

        if (Auth::user()->role === 'client') {
            // Client: only see contracts they posted
            $jobs = Auth::user()
                ->jobListings()
                ->where('duration_type', 'contract')
                ->filter($filters)
                ->get();
        } else {
            // Freelancer: see ALL contract jobs posted by clients
            $jobs = JobListing::where('duration_type', 'contract')
                ->filter($filters)
                ->get();
        }

        return view('contracts.all-contracts', compact('jobs'));
    }

    public function openContractJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        if (Auth::user()->role === 'client') {
            $jobs = Auth::user()
                ->jobListings()
                ->where('status', 'open')
                ->where('duration_type', 'contract')
                ->filter($filters)
                ->paginate(6);
        } else {
            // Freelancer sees all client-posted open contracts
            $jobs = JobListing::where('status', 'open')
                ->where('duration_type', 'contract')
                ->filter($filters)
                ->paginate(6);
        }

        return view('contracts.open-contracts', compact('jobs'));
    }

    public function inProgressContractJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        if (Auth::user()->role === 'client') {
            $jobs = Auth::user()
                ->jobListings()
                ->where('status', 'in_progress')
                ->where('duration_type', 'contract')
                ->filter($filters)
                ->paginate(6);
        } else {
            // Freelancers see only their own progress contracts
            $jobs = JobListing::where('status', 'in_progress')
                ->where('duration_type', 'contract')
                // ->where('freelancer_id', Auth::id())
                ->filter($filters)
                ->paginate(6);
        }

        return view('contracts.in-progress-contracts', compact('jobs'));
    }

    public function cancelledContractJobs(Request $request)
    {
        $filters = $request->only(['search', 'category', 'client', 'location']);

        if (Auth::user()->role === 'client') {
            $jobs = Auth::user()
                ->jobListings()
                ->where('status', 'cancelled')
                ->where('duration_type', 'contract')
                ->filter($filters)
                ->paginate(6);
        } else {
            $jobs = JobListing::where('status', 'cancelled')
                ->where('duration_type', 'contract')
                // ->where('freelancer_id', Auth::id())
                ->filter($filters)
                ->paginate(6);
        }

        return view('contracts.cancelled-contracts', compact('jobs'));
    }

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
                // ->where('freelancer_id', Auth::id())
                ->filter($filters)
                ->paginate(6);
        }

        return view('contracts.completed-contracts', compact('jobs'));
    }
}
