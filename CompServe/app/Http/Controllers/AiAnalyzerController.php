<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\User;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Exception;

class AiAnalyzerController extends Controller
{
    private const MAX_SUMMARY_WORDS = 300;
    private const MAX_PROFILE_WORDS = 250;
    private const DEFAULT_TRUST_SCORE = 50;
    private const MIN_TRUST_SCORE = 0;
    private const MAX_TRUST_SCORE = 100;
    private const MIN_ACCOUNT_AGE_MONTHS = 6;

    /**
     * Generate AI summary for a job listing
     */
    public function summarize(JobListing $jobListing): JsonResponse
    {
        try {
            $jobData = $this->prepareJobDataForSummary($jobListing);
            $prompt = $this->buildJobSummaryPrompt($jobData);

            $summary = $this->generateAiContent($prompt);

            return response()->json([
                'success' => true,
                'summary' => $summary
            ]);

        } catch (Exception $e) {
            return $this->handleError('Job summarization failed', $e);
        }
    }

    /**
     * Analyze user profile with AI
     */
    public function analyzeProfile(User $user): JsonResponse
    {
        try {
            $profileData = $this->prepareProfileData($user);

            $summary = $this->generateAiContent(
                $this->buildProfileSummaryPrompt($profileData)
            );

            $trustScore = $this->calculateTrustScore($profileData);

            return response()->json([
                'success' => true,
                'summary' => $summary,
                'trustScore' => $trustScore,
            ]);

        } catch (Exception $e) {
            return $this->handleError('Profile analysis failed', $e);
        }
    }

    /**
     * Prepare job data for summarization
     */
    private function prepareJobDataForSummary(JobListing $jobListing): array
    {
        $data = [
            'title' => $jobListing->title,
            'description' => $jobListing->description,
            'duration_type' => $jobListing->duration_type,
            'budget' => $jobListing->budget,
            'status' => $jobListing->status,
            'posted_by' => $jobListing->client->name ?? 'Unknown',
            'skills_required' => $jobListing->skills_required ?? [],
        ];

        // Add optional fields if they exist and are not empty
        $optionalFields = ['experience_level', 'deadline', 'location', 'work_type'];
        foreach ($optionalFields as $field) {
            if (!empty($jobListing->$field)) {
                $data[$field] = $jobListing->$field;
            }
        }

        return $data;
    }

    /**
     * Build prompt for job summary generation
     */
    private function buildJobSummaryPrompt(array $jobData): string
    {
        $skillsList = !empty($jobData['skills_required'])
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

        $prompt .= $this->getJobSummaryInstructions($jobData);

        return $prompt;
    }

    /**
     * Get formatting instructions for job summary
     */
    private function getJobSummaryInstructions(array $jobData): string
    {
        $instructions = "INSTRUCTIONS:\n";
        $instructions .= "Create a summary with these EXACT sections (use numbered format 1., 2., etc.):\n\n";
        $instructions .= "1. Overview - Write 2-3 engaging sentences about what this opportunity is, who it's for, and what makes it interesting\n\n";
        $instructions .= "2. What You'll Do - Use bullet points (start with -) to list 3-4 main responsibilities or tasks based on the description\n\n";
        $instructions .= "3. Required Skills - Use bullet points (start with -) to list the required skills with brief context about how they'll be used\n\n";
        $instructions .= "4. Project Details - Use bullet points (start with -) to highlight:\n";
        $instructions .= "   - Budget and payment terms\n";
        $instructions .= "   - Timeline and deadline\n";
        $instructions .= "   - Work type (" . ucfirst($jobData['duration_type']) . ")\n";

        if (isset($jobData['experience_level'])) {
            $instructions .= "   - Experience level needed\n";
        }

        $instructions .= "\n5. Why This Opportunity - Write 2-3 sentences about what makes this role valuable, interesting, or a good fit for the right candidate\n\n";

        $instructions .= "FORMATTING RULES:\n";
        $instructions .= "- Use **bold** for emphasis on key terms and skills\n";
        $instructions .= "- Start each main section with the number (1., 2., 3., etc.)\n";
        $instructions .= "- Use - for bullet points\n";
        $instructions .= "- Keep it professional but engaging\n";
        $instructions .= "- Focus on what matters to freelancers: skills needed, deliverables, compensation\n";
        $instructions .= "- Be specific and actionable, not generic\n";
        $instructions .= "- Maximum " . self::MAX_SUMMARY_WORDS . " words total\n";

        return $instructions;
    }

    /**
     * Prepare profile data for analysis
     */
    private function prepareProfileData(User $user): array
    {
        $profile = $user->profile;
        $accountAgeMonths = $user->created_at->diffInMonths(now());

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'member_since' => $user->created_at->format('F Y'),
            'account_age_months' => $accountAgeMonths,
            'about_me' => $profile->about_me ?? null,
            'contact_number' => $profile->contact_number ?? null,
            'has_social_links' => $this->hasSocialLinks($profile),
            'profile_completeness' => $this->calculateProfileCompleteness($user, $profile),
        ];

        // Add role-specific statistics
        if ($user->role === 'freelancer') {
            $data = array_merge($data, $this->getFreelancerStats($user));
        } elseif ($user->role === 'client') {
            $data = array_merge($data, $this->getClientStats($user));
        }

        return $data;
    }

    /**
     * Check if user has social links
     */
    private function hasSocialLinks($profile): bool
    {
        if (!$profile) {
            return false;
        }

        return !empty($profile->facebook) ||
            !empty($profile->instagram) ||
            !empty($profile->linkedin) ||
            !empty($profile->twitter);
    }

    /**
     * Get freelancer statistics
     */
    private function getFreelancerStats(User $user): array
    {
        return [
            'completed_jobs' => $user->jobApplications()
                ->where('status', 'completed')
                ->count(),
            'active_applications' => $user->jobApplications()
                ->where('status', 'pending')
                ->count(),
            'average_rating' => round($user->receivedReviews()->avg('rating') ?? 0, 1),
            'total_reviews' => $user->receivedReviews()->count(),
        ];
    }

    /**
     * Get client statistics
     */
    private function getClientStats(User $user): array
    {
        $totalJobsPosted = $user->jobListings()->count();
        $completedJobs = $user->jobListings()
            ->where('status', 'completed')
            ->count();

        $cancelledJobs = $user->jobListings()
            ->where('status', 'cancelled')
            ->count();

        $totalFinishedJobs = $completedJobs + $cancelledJobs;
        $completionRate = $totalFinishedJobs > 0
            ? round(($completedJobs / $totalFinishedJobs) * 100, 1)
            : 0;

        return [
            'total_jobs_posted' => $totalJobsPosted,
            'active_jobs' => $user->jobListings()
                ->where('status', 'open')
                ->count(),
            'completed_jobs' => $completedJobs,
            'cancelled_jobs' => $cancelledJobs,
            'completion_rate' => $completionRate,
        ];
    }

    /**
     * Calculate profile completeness percentage
     */
    private function calculateProfileCompleteness(User $user, $profile): int
    {
        if (!$profile) {
            return 25; // Base score for having user account only
        }

        $fields = [
            $user->name,
            $user->email,
            $profile->about_me ?? null,
            $profile->contact_number ?? null,
            $profile->facebook ?? null,
            $profile->instagram ?? null,
            $profile->linkedin ?? null,
            $profile->twitter ?? null,
        ];

        $filled = count(array_filter($fields, fn($field) => !empty($field)));
        $total = count($fields);

        return round(($filled / $total) * 100);
    }

    /**
     * Build prompt for profile summary
     */
    private function buildProfileSummaryPrompt(array $data): string
    {
        $prompt = "You are a professional profile analyst. Analyze the following user profile and provide insights.\n\n";

        $prompt .= "USER PROFILE DATA:\n";
        $prompt .= "Name: {$data['name']}\n";
        $prompt .= "Role: " . ucfirst($data['role']) . "\n";
        $prompt .= "Member Since: {$data['member_since']} ({$data['account_age_months']} months)\n";
        $prompt .= "Profile Completeness: {$data['profile_completeness']}%\n";

        if (!empty($data['about_me'])) {
            $prompt .= "About: {$data['about_me']}\n";
        }

        $prompt .= "Has Social Links: " . ($data['has_social_links'] ? 'Yes' : 'No') . "\n";

        // Add role-specific data
        if ($data['role'] === 'freelancer' && isset($data['completed_jobs'])) {
            $prompt .= $this->getFreelancerPromptData($data);
        } elseif ($data['role'] === 'client' && isset($data['total_jobs_posted'])) {
            $prompt .= $this->getClientPromptData($data);
        }

        $prompt .= "\n" . $this->getProfileAnalysisInstructions($data['role']);

        return $prompt;
    }

    /**
     * Get freelancer data for prompt
     */
    private function getFreelancerPromptData(array $data): string
    {
        return "Completed Jobs: {$data['completed_jobs']}\n" .
            "Active Applications: {$data['active_applications']}\n" .
            "Average Rating: {$data['average_rating']}/5\n" .
            "Total Reviews: {$data['total_reviews']}\n";
    }

    /**
     * Get client data for prompt
     */
    private function getClientPromptData(array $data): string
    {
        return "Total Jobs Posted: {$data['total_jobs_posted']}\n" .
            "Active Jobs: {$data['active_jobs']}\n" .
            "Completed Jobs: {$data['completed_jobs']}\n" .
            "Cancelled Jobs: {$data['cancelled_jobs']}\n" .
            "Completion Rate: {$data['completion_rate']}%\n";
    }

    /**
     * Get instructions for profile analysis
     */
    private function getProfileAnalysisInstructions(string $role): string
    {
        $instructions = "Create a professional analysis with these EXACT sections (use numbered format 1., 2., etc.):\n\n";
        $instructions .= "1. Profile Overview - 2-3 sentences summarizing this user's profile and experience\n\n";
        $instructions .= "2. Strengths - Use bullet points (start with -) to list 3-4 positive aspects of this profile\n\n";
        $instructions .= "3. Areas for Improvement - Use bullet points (start with -) to suggest 2-3 ways to enhance the profile\n\n";

        if ($role === 'freelancer') {
            $instructions .= "4. Work History Insights - Use bullet points to analyze their job completion rate, ratings, and reliability\n\n";
        } else {
            $instructions .= "4. Client Activity - Use bullet points to analyze their job posting patterns, completion rate, cancelled jobs, and engagement\n\n";
        }

        $instructions .= "FORMATTING RULES:\n";
        $instructions .= "- Use **bold** for emphasis on key points\n";
        $instructions .= "- Start each section with number (1., 2., 3., etc.)\n";
        $instructions .= "- Use - for bullet points\n";
        $instructions .= "- Be professional, objective, and constructive\n";

        if ($role === 'client') {
            $instructions .= "- Mention completion rate and any concerns about cancelled jobs\n";
        }

        $instructions .= "- Keep it concise but informative\n";
        $instructions .= "- Maximum " . self::MAX_PROFILE_WORDS . " words\n";

        return $instructions;
    }

    /**
     * Calculate trust score based on profile data
     */
    private function calculateTrustScore(array $data): int
    {
        try {
            $prompt = $this->buildTrustScorePrompt($data);
            $response = $this->generateAiContent($prompt);
            return $this->parseTrustScore($response);
        } catch (Exception $e) {
            Log::warning('Trust score calculation failed, using heuristic: ' . $e->getMessage());
            return $this->calculateHeuristicTrustScore($data);
        }
    }

    /**
     * Build prompt for trust score calculation
     */
    private function buildTrustScorePrompt(array $data): string
    {
        $prompt = "You are a trust assessment expert. Calculate a trust score (0-100) for this user profile.\n\n";

        $prompt .= "PROFILE DATA:\n";
        $prompt .= "Account Age: {$data['account_age_months']} months\n";
        $prompt .= "Profile Completeness: {$data['profile_completeness']}%\n";
        $prompt .= "Has Social Links: " . ($data['has_social_links'] ? 'Yes' : 'No') . "\n";

        if ($data['role'] === 'freelancer' && isset($data['completed_jobs'])) {
            $prompt .= "Completed Jobs: {$data['completed_jobs']}\n";
            $prompt .= "Average Rating: {$data['average_rating']}/5\n";
            $prompt .= "Total Reviews: {$data['total_reviews']}\n";
        } elseif ($data['role'] === 'client' && isset($data['total_jobs_posted'])) {
            $prompt .= "Jobs Posted: {$data['total_jobs_posted']}\n";
            $prompt .= "Completed Projects: {$data['completed_jobs']}\n";
            $prompt .= "Cancelled Projects: {$data['cancelled_jobs']}\n";
            $prompt .= "Completion Rate: {$data['completion_rate']}%\n";
        }

        $prompt .= "\nCRITERIA FOR TRUST SCORE:\n";
        $prompt .= "- Account age (newer = lower trust, " . self::MIN_ACCOUNT_AGE_MONTHS . "+ months = higher)\n";
        $prompt .= "- Profile completeness (higher % = higher trust)\n";
        $prompt .= "- Verified contact info and social links (increases trust)\n";

        if ($data['role'] === 'client') {
            $prompt .= "- Completion rate (higher % = higher trust, low rate significantly reduces trust)\n";
            $prompt .= "- Cancelled jobs (high cancellation rate significantly reduces trust)\n";
            $prompt .= "IMPORTANT: A completion rate below 70% should result in a significant trust penalty.\n";
            $prompt .= "Multiple cancelled jobs indicate unreliability and should lower the score.\n";
        }

        $prompt .= "- Job completion rate and reviews (for freelancers)\n";
        $prompt .= "- Active job postings (for clients)\n";
        $prompt .= "- Overall activity and engagement\n\n";

        $prompt .= "Provide ONLY a number between 0-100 representing the trust score.\n";
        $prompt .= "Output format: Just the number, nothing else.\n";
        $prompt .= "Example: 75\n";

        return $prompt;
    }

    /**
     * Parse trust score from AI response
     */
    private function parseTrustScore(string $response): int
    {
        preg_match('/\d+/', $response, $matches);

        if (empty($matches)) {
            return self::DEFAULT_TRUST_SCORE;
        }

        $score = (int) $matches[0];

        return max(self::MIN_TRUST_SCORE, min(self::MAX_TRUST_SCORE, $score));
    }

    /**
     * Calculate trust score using heuristic method (fallback)
     */
    private function calculateHeuristicTrustScore(array $data): int
    {
        $score = 0;

        // Account age (max 25 points)
        $accountAgeScore = min(25, ($data['account_age_months'] / 12) * 25);
        $score += $accountAgeScore;

        // Profile completeness (max 30 points)
        $score += ($data['profile_completeness'] / 100) * 30;

        // Social links (10 points)
        if ($data['has_social_links']) {
            $score += 10;
        }

        // Role-specific scoring
        if ($data['role'] === 'freelancer' && isset($data['completed_jobs'])) {
            // Completed jobs (max 20 points)
            $score += min(20, $data['completed_jobs'] * 2);

            // Rating (max 15 points)
            $score += ($data['average_rating'] / 5) * 15;

        } elseif ($data['role'] === 'client' && isset($data['total_jobs_posted'])) {
            // Jobs posted (max 15 points)
            $score += min(15, $data['total_jobs_posted'] * 2);

            // Completion rate (max 25 points) - CRITICAL FACTOR FOR CLIENTS
            if (isset($data['completion_rate'])) {
                $completionRateScore = ($data['completion_rate'] / 100) * 25;
                $score += $completionRateScore;
            }

            // Penalty for cancelled jobs (reduce up to 10 points)
            $cancellationPenalty = min(10, $data['cancelled_jobs'] * 2);
            $score -= $cancellationPenalty;
        }

        return (int) max(self::MIN_TRUST_SCORE, min(self::MAX_TRUST_SCORE, $score));
    }

    /**
     * Generate AI content using Gemini
     */
    private function generateAiContent(string $prompt): string
    {
        $model = config('gemini.model', 'gemini-2.5-flash');

        $result = Gemini::generativeModel(model: $model)
            ->generateContent($prompt);

        return $result->text();
    }

    /**
     * Handle errors consistently
     */
    private function handleError(string $context, Exception $e): JsonResponse
    {
        Log::error("{$context}: " . $e->getMessage());
        Log::error('Stack trace: ' . $e->getTraceAsString());

        return response()->json([
            'success' => false,
            'error' => 'Sorry, there was an error processing your request. Please try again.'
        ], 500);
    }
}