<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Mail\JobApplicationCancelled;
use App\Mail\JobApplicationSubmitted;
use App\Models\JobApplication;
use App\Models\JobListing;
use Gemini\Laravel\Facades\Gemini;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

    // AI summary functions
    public function summarize(JobListing $jobListing)
    {
        try {
            // Prepare the job data for summarization
            $jobData = $this->prepareJobDataForSummary($jobListing);

            // Build the prompt
            $prompt = $this->buildPrompt($jobData);

            // Call Gemini API using the facade
            $model = config('gemini.model', 'gemini-2.5-flash');
            $result = Gemini::generativeModel(model: $model)
                ->generateContent($prompt);

            return response()->json([
                'success' => true,
                'summary' => $result->text()
            ]);

        } catch (\Exception $e) {
            Log::error('Job summarization failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Failed to generate summary. Please try again later.'
            ], 500);
        }
    }

    private function prepareJobDataForSummary(JobListing $jobListing)
    {
        $data = [
            'title' => $jobListing->title,
            'description' => $jobListing->description,
            'duration_type' => $jobListing->duration_type,
            'budget' => $jobListing->budget,
            'status' => $jobListing->status,
            'posted_by' => $jobListing->client->name,
        ];

        // Add skills if available
        if (!empty($jobListing->skills_required)) {
            $data['skills_required'] = $jobListing->skills_required;
        }

        // Add optional fields if they exist
        $optionalFields = ['experience_level', 'deadline', 'location', 'work_type'];
        foreach ($optionalFields as $field) {
            if (isset($jobListing->$field) && !empty($jobListing->$field)) {
                $data[$field] = $jobListing->$field;
            }
        }

        return $data;
    }

    private function buildPrompt(array $jobData)
    {
        $skillsList = isset($jobData['skills_required'])
            ? implode(', ', $jobData['skills_required'])
            : 'Not specified';

        $prompt = "You are a professional job listing analyst. Create an engaging and well-structured summary of this job opportunity.\n\n";

        $prompt .= "JOB DETAILS:\n";
        $prompt .= "Title: {$jobData['title']}\n";
        $prompt .= "Type: " . ucfirst($jobData['duration_type']) . "\n";
        $prompt .= "Budget: ₱" . number_format($jobData['budget'], 2) . "\n";
        $prompt .= "Posted by: {$jobData['posted_by']}\n";
        $prompt .= "Status: " . ucfirst($jobData['status']) . "\n";
        $prompt .= "Required Skills: {$skillsList}\n";

        if (isset($jobData['experience_level'])) {
            $prompt .= "Experience Level: {$jobData['experience_level']}\n";
        }

        if (isset($jobData['deadline'])) {
            $prompt .= "Deadline: {$jobData['deadline']}\n";
        }

        $prompt .= "\nDESCRIPTION:\n{$jobData['description']}\n\n";

        $prompt .= "INSTRUCTIONS:\n";
        $prompt .= "Create a summary with these EXACT sections (use numbered format 1., 2., etc.):\n\n";
        $prompt .= "1. Overview - Write 2-3 engaging sentences about what this opportunity is, who it's for, and what makes it interesting\n\n";
        $prompt .= "2. What You'll Do - Use bullet points (start with -) to list 3-4 main responsibilities or tasks based on the description\n\n";
        $prompt .= "3. Required Skills - Use bullet points (start with -) to list the required skills with brief context about how they'll be used\n\n";
        $prompt .= "4. Project Details - Use bullet points (start with -) to highlight:\n";
        $prompt .= "   - Budget and payment terms\n";
        $prompt .= "   - Timeline and deadline\n";
        $prompt .= "   - Work type (" . ucfirst($jobData['duration_type']) . ")\n";

        if (isset($jobData['experience_level'])) {
            $prompt .= "   - Experience level needed\n";
        }

        $prompt .= "\n5. Why This Opportunity - Write 2-3 sentences about what makes this role valuable, interesting, or a good fit for the right candidate\n\n";

        $prompt .= "FORMATTING RULES:\n";
        $prompt .= "- Use **bold** for emphasis on key terms and skills\n";
        $prompt .= "- Start each main section with the number (1., 2., 3., etc.)\n";
        $prompt .= "- Use - for bullet points\n";
        $prompt .= "- Keep it professional but engaging\n";
        $prompt .= "- Focus on what matters to freelancers: skills needed, deliverables, compensation\n";
        $prompt .= "- Be specific and actionable, not generic\n";
        $prompt .= "- Maximum 300 words total\n";

        return $prompt;
    }
}
