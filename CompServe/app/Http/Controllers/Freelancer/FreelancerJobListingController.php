<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Client\ClientJobListingController;
use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelancerJobListingController extends Controller
{
    public function index()
    {
        dd("Index show all jobs");
    }

    public function show(JobListing $jobListing)
    {
        return view('freelancer.jobs.show-job', compact('jobListing'));
    }

    public function applyForJob(Request $request)
    {
        // TODO: email the freelancer that they have successfully applied for the job
        // TODO: implement uploading of cover letter functionality
        // Validate request
        $validated = $request->validate([
            'jobId' => ['required', 'exists:job_listings,id'],
            'cover_letter' => ['nullable', 'string', 'max:2000'],
        ]);

        // Fetch job
        $job = JobListing::findOrFail($validated['jobId']);

        // Check if job is still open
        if ($job->status !== 'open') {
            return back()->withErrors(['jobId' => 'This job is no longer open for applications.']);
        }

        // Prevent duplicate applications
        $alreadyApplied = JobApplication::where('job_id', $job->id)
            ->where('freelancer_id', Auth::id())
            ->exists();

        if ($alreadyApplied) {
            return back()->withErrors(['jobId' => 'You have already applied for this job.']);
        }

        // Create application
        JobApplication::create([
            'job_id' => $job->id,
            'freelancer_id' => Auth::id(),
            'client_id' => $job->client_id, // make sure JobListing has client_id field
            'cover_letter' => $validated['cover_letter'] ?? null,
        ]);

        // Redirect with success
        return redirect()
            // ->route('freelancer.jobs.available')
            ->route('freelancer.jobs.show', $job)
            ->with('success', 'Applied for job successfully!');
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    public function availableJobs()
    {
        $jobs = JobListing::where('status', 'open')->paginate(6);

        return view('freelancer.jobs.available-jobs', compact('jobs'));
    }

    public function appliedJobs()
    {
        $freelancerId = Auth::id();

        $appliedJobs = JobApplication::with('job') // eager load job relationship
            ->where([
                ['freelancer_id', $freelancerId],
                ['status', 'pending']
            ])
            ->latest()
            ->paginate(6);

        return view('freelancer.jobs.applied-jobs', compact('appliedJobs'));
    }

    public function currentJobs()
    {
        $freelancerId = Auth::id();

        $currentJobs = JobApplication::with('job')
            ->where('freelancer_id', $freelancerId)
            ->where('status', 'accepted')
            ->latest()
            ->paginate(6);

        return view('freelancer.jobs.current-jobs', compact('currentJobs'));
    }

    public function completedJobs()
    {
        $freelancerId = Auth::id();

        $completedJobs = JobApplication::with('job')
            ->where('freelancer_id', $freelancerId)
            ->where('status', 'completed')
            ->latest()
            ->paginate(6);


        return view('freelancer.jobs.completed-jobs', compact('completedJobs'));
    }

    public function rejectedJobs()
    {
        $freelancerId = Auth::id();

        $rejectedJobs = JobApplication::with('job')
            ->where('freelancer_id', $freelancerId)
            ->where('status', 'rejected')
            ->latest()
            ->paginate(6);

        return view('freelancer.jobs.rejected-jobs', compact('rejectedJobs'));
    }
}
