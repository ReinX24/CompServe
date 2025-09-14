<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientJobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Auth::user()->jobListings;

        return view('client.jobs.all-jobs', compact('jobs'));
    }

    public function postedJobs()
    {
        $jobs = Auth::user()->jobListings()->where("status", "open")->paginate(6);

        return view('freelancer.jobs.available-jobs', compact('jobs'));
    }

    public function inProgressJobs()
    {
        $jobs = Auth::user()->jobListings()->where("status", "in_progress")->paginate(6);

        return view('client.jobs.in-progress-jobs', compact('jobs'));
    }

    public function completedJobs()
    {
        $jobs = Auth::user()->jobListings()->where("status", "completed")->paginate(6);

        return view('client.jobs.completed-jobs', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("client.jobs.create-job");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'skills_required' => 'nullable|array', // multiple skills
            'skills_required.*' => 'nullable|string|max:100',
            'budget_type' => 'required|in:fixed,hourly',
            'budget' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'deadline' => 'nullable|date|after:today',
            'status' => 'nullable|in:open,closed',
        ]);

        // Create job listing
        $job = new JobListing();
        $job->client_id = Auth::user()->id;
        $job->title = $validated['title'];
        $job->description = $validated['description'];
        $job->category = $validated['category'];
        $job->skills_required = $validated['skills_required'] ?? []; // store as JSON
        $job->budget_type = $validated['budget_type'];
        $job->budget = $validated['budget'];
        $job->location = $validated['location'] ?? null;
        $job->deadline = $validated['deadline'] ?? null;
        $job->status = $validated['status'] ?? 'open';

        $job->save();

        // Redirect with success message
        return redirect()
            ->route('client.jobs.posts')
            ->with('success', 'Job listing created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobListing $jobListing)
    {
        // eager load applicants + freelancer relationship
        $applicants = $jobListing->applications()
            ->with('freelancer')
            ->latest()
            ->take(3)
            ->get();

        return view('client.jobs.show-job', compact('jobListing', 'applicants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobListing $jobListing)
    {
        return view('client.jobs.edit-job', compact('jobListing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobListing $jobListing)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|in:Hardware,Software,Networking',
            'skills_required' => 'nullable|array',
            'skills_required.*' => 'nullable|string|max:255',
            'budget_type' => 'required|string|in:fixed,hourly',
            'budget' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'deadline' => 'nullable|date|after:today',
        ]);

        $jobListing->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'skills_required' => $validated['skills_required'] ?? [],
            'budget_type' => $validated['budget_type'],
            'budget' => $validated['budget'] ?? null,
            'location' => $validated['location'] ?? null,
            'deadline' => $validated['deadline'] ?? null,
        ]);

        return redirect()
            ->route('client.jobs.show', compact('jobListing'))
            ->with('success', 'Job listing updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobListing $jobListing)
    {
        $jobListing->delete();

        return redirect()
            ->route('client.jobs.posts')
            ->with('success', 'Job listing deleted successfully!');
    }
}
