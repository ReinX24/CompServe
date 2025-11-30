<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Mail\JobApplicationCancelled;
use App\Mail\JobApplicationSubmitted;
use App\Models\JobApplication;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

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

    public function applyForJob(Request $request, JobListing $jobListing)
    {
        $validated = $request->validate([
            'cover_letter' => 'nullable|string',
        ]);

        $existing = JobApplication::withTrashed()
            ->where('job_id', $jobListing->id)
            ->where('freelancer_id', Auth::id())
            ->first();

        if ($existing) {
            $existing->restore();

            $existing->cover_letter = $validated['cover_letter'] ??
                $existing->cover_letter;

            $existing->save();
            $application = $existing;
        } else {
            $application = JobApplication::create([
                'job_id' => $jobListing->id,
                'freelancer_id' => Auth::id(),
                'client_id' => $jobListing->client_id,
                'cover_letter' => $validated['cover_letter'] ?? null,
            ]);
        }

        // Send email to freelancer
        // Mail::to($application->freelancer->email)
        //     ->queue(new JobApplicationSubmitted(
        //         $jobListing,
        //         $application
        //     ));

        return redirect()
            ->route('freelancer.jobs.show', $jobListing)
            ->with('success', 'Applied for job successfully!');
    }

    public function deleteJobApplication(JobListing $jobListing)
    {
        $jobApplication = JobApplication::where([
            ['freelancer_id', Auth::id()],
            ['job_id', $jobListing->id],
        ])->first();

        if (!$jobApplication) {
            return redirect()->back()->with('error', 'Application not found.');
        }

        // Store before deletion
        $application = $jobApplication;

        if ($jobListing->status === "in_progress") {
            $jobApplication->status = "cancelled";
            $jobApplication->save();

            $jobListing->status = "cancelled";
            $jobListing->save();

            // Send email
            Mail::to($application->freelancer->email)
                ->queue(new JobApplicationCancelled(
                    $jobListing,
                    $application
                ));

            return redirect()->route(
                'freelancer.jobs.show',
                $jobListing
            )
                ->with('success', 'Cancelled job successfully.');
        } else {
            // Send email before deletion
            // Mail::to($application->freelancer->email)
            //     ->queue(new JobApplicationCancelled(
            //         $jobListing,
            //         $application
            //     ));

            $jobApplication->delete();

            return redirect()->route('freelancer.jobs.show', $jobListing)
                ->with('success', 'Removed application successfully.');
        }
    }

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
