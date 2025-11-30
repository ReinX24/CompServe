<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\ApplicantAcceptedMail;
use App\Mail\ApplicantRejectedMail;
use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ClientJobListingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $jobType = $request->query('type', 'contract');
        return view("client.jobs.create-job", compact("jobType"));
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
            'location' => 'required|string|max:255',
            'deadline' => 'nullable|date|after:today',
            'duration' => 'required|string|in:1 day,3 days,5 days,1 week,1 month,3 months,6 months,1 year',
            'status' => 'nullable|in:open,closed',
            'duration_type' => 'required|in:gig,contract',
        ]);

        // Create job listing
        $jobListing = new JobListing();
        $jobListing->client_id = Auth::user()->id;
        $jobListing->duration_type = $validated['duration_type'];
        $jobListing->title = $validated['title'];
        $jobListing->description = $validated['description'];
        $jobListing->category = $validated['category'];
        $jobListing->skills_required = $validated['skills_required'] ?? []; // store as JSON
        $jobListing->budget_type = $validated['budget_type'];
        $jobListing->budget = $validated['budget'];
        $jobListing->location = $validated['location'] ?? null;
        $jobListing->deadline = $validated['deadline'] ?? null;
        $jobListing->status = $validated['status'] ?? 'open';

        $jobListing->save();

        // Redirect with success message
        return redirect()
            ->route('client.jobs.show', compact('jobListing'))
            ->with('success', 'Job listing added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobListing $jobListing)
    {
        // eager load applicants + freelancer relationship
        if ($jobListing->status === "open") {
            $applicants = $jobListing->applications()
                ->with('freelancer')
                ->where('status', 'pending')
                ->latest()
                ->take(3)
                ->get();

            return view('client.jobs.show-job', compact('jobListing', 'applicants'));
        } elseif ($jobListing->status === "in_progress") {
            // Get the accepted applicant
            $applicant = $jobListing->applications()->where('status', 'accepted')->first();
            // Getting the applicant that has been accepted for the job
            $user = User::findOrFail($applicant->freelancer_id);

            return view('client.jobs.show-job', compact('jobListing', 'applicant', 'user'));
        } elseif ($jobListing->status === "completed") {
            // Get the completed applicant
            $applicant = $jobListing->applications()->where('status', 'completed')->first();

            // Getting the applicant that has been accepted for the job
            $user = User::findOrFail($applicant->freelancer_id);

            return view('client.jobs.show-job', compact('jobListing', 'applicant', 'user'));
        } else if ($jobListing->status === "cancelled") {
            // Get the accepted applicant or the rejected applicant
            $applicant = $jobListing->applications()->where(
                'status',
                'cancelled'
            )->first();

            // Getting the applicant that has been accepted for the job
            $user = User::findOrFail($applicant->freelancer_id);

            return view('client.jobs.show-job', compact('jobListing', 'applicant', 'user'));
        }
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
        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'skills_required' => 'nullable|array',
            'skills_required.*' => 'nullable|string|max:255',
            'budget_type' => 'required|string|in:fixed,hourly',
            'budget' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'deadline' => 'nullable|date|after:today',
            'duration_type' => 'required|in:gig,contract',
            'duration' => 'required|string|in:1 day,3 days,5 days,1 week,1 month,3 months,6 months,1 year', // <-- add this
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
            'duration_type' => $validated['duration_type'],
            'duration' => $validated['duration'],
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
            ->route('dashboard')
            ->with('success', 'Job listing deleted successfully!');
    }

    // Show all applicants
    public function allApplicants(JobListing $jobListing)
    {
        // dd($jobListing->applications()->get());
        $applications = $jobListing->applications()->with('freelancer')->latest()->get();

        return view('client.applicant.all-applicants', compact('jobListing', 'applications'));
    }

    // Show single applicant
    public function showApplicant(JobListing $jobListing, User $user)
    {
        $freelancerInfo = $user->freelancerInformation;

        if ($freelancerInfo) {
            // If the user has freelancerInfo
            $reviews = Review::with('jobListing')->where('freelancer_id', $freelancerInfo->user_id)->get();
        } else {
            // If the user does not have freelancerInfo
            $reviews = Review::with('jobListing')->where('freelancer_id', $user->id)->get();
        }

        $averageRating = $reviews->avg('rating');

        $applicationInfo = $jobListing->applications()->where('freelancer_id', $user->id)->first();

        return view('client.applicant.applicant-profile-show', compact('freelancerInfo', 'applicationInfo', 'user', 'averageRating', 'jobListing'));
    }

    public function acceptApplicant(JobApplication $application)
    {
        // 1. Accept the chosen applicant
        $application->status = "accepted";
        $application->save();

        // 2. Set job status to in progress
        $jobListing = JobListing::findOrFail($application->job_id);
        $jobListing->status = "in_progress";
        $jobListing->save();

        // 3. Reject all other applicants for the same job
        $rejectedApplicants = JobApplication::where('job_id', $application->job_id)
            ->where('id', '!=', $application->id)
            ->get();

        foreach ($rejectedApplicants as $applicant) {
            $applicant->status = "rejected";
            $applicant->save();
        }

        // 4. Email the accepted applicant
        // TODO: make the job viewable by guests but limited interactions
        Mail::to($application->freelancer->email)
            ->queue(new ApplicantAcceptedMail(
                $application
            ));

        // 5. Redirect
        return redirect()
            ->route('client.jobs.show', $jobListing)
            ->with('success', 'Accepted applicant!');
    }


    public function rejectApplicant(JobApplication $application)
    {
        // Update application status
        $application->update(['status' => 'rejected']);

        // Send rejection email
        Mail::to($application->freelancer->email)
            ->queue(new ApplicantRejectedMail($application));

        // Redirect back to job details
        return redirect()
            ->route('client.jobs.show', $application->job)
            ->with('success', 'Rejected applicant!');
    }

    public function markJobAsComplete(Request $request, JobListing $jobListing)
    {
        // Before marking, set review for the freelancer and the job
        if ($request->filled('rating')) {
            Review::create([
                'client_id' => Auth::id(),
                'freelancer_id' => $request->freelancer_id,
                'job_listing_id' => $jobListing->id,
                'rating' => $request->rating,
                'comments' => $request->comments,
            ]);
        }

        // Setting job_listing as complete
        $jobListing->status = "completed";
        $jobListing->save();

        // Get accepted job application and turn it into complete
        $jobApplication = $jobListing->applications()->where(
            'status',
            'accepted'
        )->first();
        $jobApplication->status = "completed";
        $jobApplication->save();

        // Redirect back to page showing job information
        return redirect()->route(
            'client.jobs.show',
            $jobListing
        )
            ->with('success', 'Job completed!');
    }

    public function markJobAsCancelled(Request $request, JobListing $jobListing)
    {
        // Make the accepted job application for the job into cancelled
        $jobApplication = JobApplication::where([
            ['freelancer_id', $request->freelancer_id],
            ['job_id', $jobListing->id],
        ])->first();

        // Set the job application as cancelled if the job is cancelled
        $jobApplication->status = "cancelled";
        $jobApplication->save();

        $jobListing->status = "cancelled";

        $jobListing->save();

        // Redirect back to page showing job information
        return redirect()->route(
            'client.jobs.show',
            $jobListing
        )
            ->with('success', 'Job cancelled!');
    }
}
