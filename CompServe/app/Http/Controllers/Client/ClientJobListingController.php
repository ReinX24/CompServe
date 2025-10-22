<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\Review;
use App\Models\User;
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

    public function postedJobs(Request $request)
    {
        // dd("posted jobs");
        $search = $request->input('search');
        $category = $request->input('category');
        $client = $request->input('client');

        // Get location from the field
        $location = $request->input('location');

        $jobs = Auth::user()->jobListings()->where(
            "status",
            "open"
        )
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
            )->when($location, function ($query, $location) {
                $query->where('location', 'like', "%$location%");
            })->
            paginate(6);

        return view('client.jobs.available-jobs', compact('jobs'));
    }

    public function openGigJobs(Request $request)
    {
        // TODO: comeplete this function
        dd("OPEN GIG JOBS");
    }

    public function openContractJobs(Request $request)
    {
        // TODO: comeplete this function
        dd("OPEN CONTRACT JOBS");
    }

    public function inProgressJobs(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $client = $request->input('client');

        $jobs = Auth::user()->jobListings()->where(
            "status",
            "in_progress"
        )
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
            )->
            paginate(6);

        return view('client.jobs.in-progress-jobs', compact('jobs'));
    }

    public function inProgressGigJobs(Request $request)
    {
        // TODO: comeplete this function
    }

    public function inProgressContractJobs(Request $request)
    {
        // TODO: comeplete this function
    }

    public function cancelledJobs(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $client = $request->input('client');

        $jobs = Auth::user()->jobListings()->where(
            "status",
            "cancelled"
        )
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
            )->
            paginate(6);

        return view('client.jobs.cancelled-jobs', compact('jobs'));
    }

    public function cancelledGigJobs(Request $request)
    {
        // TODO: comeplete this function
    }

    public function cancelledContractJobs(Request $request)
    {
        // TODO: comeplete this function
    }

    public function completedJobs(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $client = $request->input('client');

        $jobs = Auth::user()->jobListings()->where(
            "status",
            "completed"
        )
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
            )->
            paginate(6);

        return view('client.jobs.completed-jobs', compact('jobs'));
    }

    public function completedGigJobs(Request $request)
    {
        // TODO: comeplete this function
    }

    public function completedContractJobs(Request $request)
    {
        // TODO: comeplete this function
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
            'location' => 'required|string|max:255',
            'deadline' => 'nullable|date|after:today',
            'status' => 'nullable|in:open,closed',
        ]);

        // Create job listing
        $jobListing = new JobListing();
        $jobListing->client_id = Auth::user()->id;
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
        } else {
            // TODO: add cancelled jobs here
            // Get the accepted applicant or the rejected applicant
            $applicant = $jobListing->applications()->where(
                'status',
                'accepted'
            )->orWhere(
                    'status',
                    'rejected'
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

        return view('client.applicant.applicant-profile-show', compact('freelancerInfo', 'applicationInfo', 'user', 'averageRating'));
    }

    public function acceptApplicant(JobApplication $application)
    {
        // Change job_application to accepted
        $application->status = "accepted";

        $application->save();

        // Change jobListing status to in_progress
        $jobListing = JobListing::findOrFail($application->job_id);

        $jobListing->status = "in_progress";

        $jobListing->save();

        // All job applications for the job that are not the current job application will be rejected
        $rejectedApplicants = JobApplication::where([
            ['id', '!=', $application->id],
            ['job_id', '=', $application->job_id]
        ])->get();

        foreach ($rejectedApplicants as $applicant) {
            $applicant->status = "rejected";
            $applicant->save();
        }

        // Redirect back to page showing job information
        return redirect()->route('client.jobs.show', $jobListing);
    }

    public function markJobAsComplete(Request $request, JobListing $jobListing)
    {
        // Before marking, set review for the freelancer and the job
        if ($request->filled('rating')) {
            Review::create([
                'client_id' => Auth::id(),
                'freelancer_id' => $request->user_id,
                'job_listing_id' => $jobListing->id,
                'rating' => $request->rating,
                'comments' => $request->comments,
            ]);
        }

        // Setting job_listing as complete
        $jobListing->status = "completed";

        $jobListing->save();

        // Get accepted job application and turn it into complete
        $jobApplication = $jobListing->applications()->where('status', 'accepted')->first();
        $jobApplication->status = "completed";

        $jobApplication->save();

        // Redirect back to page showing job information
        return redirect()->route('client.jobs.show', $jobListing);
    }

    public function markJobAsCancelled(Request $request, JobListing $jobListing)
    {
        // Make the accepted job application for the job into rejected
        $jobApplication = JobApplication::where([
            ['freelancer_id', $request->freelancer_id],
            ['job_id', $jobListing->id],
        ])->first();

        // Reject the job application if the job is cancelled
        $jobApplication->status = "rejected";
        $jobApplication->save();

        $jobListing->status = "cancelled";

        $jobListing->save();

        // Redirect back to page showing job information
        return redirect()->route('client.jobs.show', $jobListing);
    }
}
