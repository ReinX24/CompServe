<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Client\ClientJobListingController;
use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\User;
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

    public function deleteJobApplication(JobListing $jobListing)
    {
        // Check if the current job is in progress, if the freelancer chooses to cancel while in progress cancel the listing
        if ($jobListing->status === "in_progress") {
            $jobListing->status = "cancelled";
            $jobListing->save();
        } else {
            // If the job is not in_progress yet or the user has not been accepted, just delete their application
            // Get the job application with the current user's id and job_listing id
            $jobApplication = JobApplication::where([
                ['freelancer_id', Auth::user()->id],
                ['job_id', $jobListing->id],
            ])->first();

            $jobApplication->delete();
        }

        // dd($jobListing->status);
        // dd($jobListing->applications()->where('freelancer_id', Auth::user()->id)->first());

        return redirect()->route(
            'freelancer.jobs.show',
            $jobListing
        )->with('success', 'Removed application successfully.');
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

    // TODO: Test search functionalities
    public function availableJobs(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $client = $request->input('client');

        $jobs = JobListing::where('status', 'open')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($category, function ($query, $category) {
                $query->where('category', $category);
            })
            ->when(
                $client,
                fn($q) =>
                $q->whereHas(
                    'client',
                    fn($q2) =>
                    $q2->where('name', 'like', "%$client%")
                )
            )
            ->paginate(6)
            ->withQueryString();

        return view('freelancer.jobs.available-jobs', compact('jobs', 'search', 'category'));
    }

    public function appliedJobs(Request $request)
    {
        $freelancerId = Auth::id();

        $query = JobApplication::with(['job', 'job.client']) // eager load job
            ->where('freelancer_id', $freelancerId)
            ->where('status', 'pending');

        $search = $request->input('search');
        $category = $request->input('category');
        $client = $request->input('client');

        $query->whereHas('job', function ($q) use ($search, $category, $client) {
            $q->where('title', 'like', "%{$search}%")
                ->where('description', 'like', "%{$search}%")
                ->where('category', 'like', "%{$category}%")
                ->whereHas('client', function ($cq) use ($client) {
                    $cq->where('name', 'like', "%{$client}%");
                });
        });

        $appliedJobs = $query->latest()->paginate(6);

        return view('freelancer.jobs.applied-jobs', [
            'appliedJobs' => $appliedJobs,
            'search' => $request->input('search') // keep old search value
        ]);
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
