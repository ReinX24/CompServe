<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelancerJobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function availableJobs()
    {
        return view('freelancer.jobs.available-jobs');
    }

    public function appliedJobs()
    {
        return view('freelancer.jobs.applied-jobs');
    }

    public function currentJobs()
    {
        return view('freelancer.jobs.current-jobs');
    }

    public function completedJobs()
    {
        return view('freelancer.jobs.completed-jobs');
    }
}
