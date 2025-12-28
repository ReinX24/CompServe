<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\User;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AiAnalyzerController extends Controller
{
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

    /**
     * Analyze user profile with AI
     */
    public function analyzeProfile(User $user)
    {
        try {
            // Gather profile data
            $profileData = $this->prepareProfileData($user);

            // Build prompts for analysis
            $summaryPrompt = $this->buildProfileSummaryPrompt($profileData);
            $trustPrompt = $this->buildTrustScorePrompt($profileData);

            $model = config('gemini.model', 'gemini-2.5-flash');

            // Get profile summary
            $summaryResult = Gemini::generativeModel(model: $model)
                ->generateContent($summaryPrompt);

            // Get trust score
            $trustResult = Gemini::generativeModel(model: $model)
                ->generateContent($trustPrompt);

            // Parse trust score
            $trustScore = $this->parseTrustScore($trustResult->text());

            return response()->json([
                'success' => true,
                'summary' => $summaryResult->text(),
                'trustScore' => $trustScore,
            ]);

        } catch (\Exception $e) {
            Log::error('Profile analysis failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                // Technical error
                // 'error' => 'Failed to analyze profile: ' . $e->getMessage(),
                // User friendly
                'error' => 'Sorry, there was an error processing your request. Please try again.'
            ], 500);
        }
    }

    /**
     * Prepare profile data for analysis
     */
    private function prepareProfileData(User $user)
    {
        $profile = $user->profile;

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'member_since' => $user->created_at->format('F Y'),
            'account_age_months' => $user->created_at->diffInMonths(now()),
            // Set defaults for fields that might not exist
            'about_me' => null,
            'contact_number' => null,
            'has_social_links' => false,
            'profile_completeness' => 0,
        ];

        if ($profile) {
            $data['about_me'] = $profile->about_me ?? null;
            $data['contact_number'] = $profile->contact_number ?? null;
            $data['has_social_links'] = !empty($profile->facebook) ||
                !empty($profile->instagram) ||
                !empty($profile->linkedin) ||
                !empty($profile->twitter);
            $data['profile_completeness'] = $this->calculateProfileCompleteness($user, $profile);
        }

        // Add work/job statistics if freelancer
        if ($user->role === 'freelancer') {
            $data['completed_jobs'] = $user->jobApplications()
                ->where('status', 'completed')
                ->count();
            $data['active_applications'] = $user->jobApplications()
                ->where('status', 'pending')
                ->count();
            $data['average_rating'] = $user->receivedReviews()->avg('rating') ?? 0;
            $data['total_reviews'] = $user->receivedReviews()->count();
        }

        // Add posted jobs if client
        if ($user->role === 'client') {
            $data['total_jobs_posted'] = $user->jobListings()->count();
            $data['active_jobs'] = $user->jobListings()
                ->where('status', 'open')
                ->count();
            $data['completed_jobs'] = $user->jobListings()
                ->where('status', 'completed')
                ->count();
        }

        return $data;
    }

    /**
     * Calculate profile completeness percentage
     */
    private function calculateProfileCompleteness(User $user, $profile)
    {
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

        if (isset($data['about_me']) && !empty($data['about_me'])) {
            $prompt .= "About: {$data['about_me']}\n";
        }

        if (isset($data['has_social_links'])) {
            $prompt .= "Has Social Links: " . ($data['has_social_links'] ? 'Yes' : 'No') . "\n";
        }

        // Only add freelancer stats if they exist
        if (isset($data['completed_jobs']) && $data['role'] === 'freelancer') {
            $prompt .= "Completed Jobs: {$data['completed_jobs']}\n";
            $prompt .= "Active Applications: {$data['active_applications']}\n";
            $prompt .= "Average Rating: " . number_format($data['average_rating'], 1) . "/5\n";
            $prompt .= "Total Reviews: {$data['total_reviews']}\n";
        }

        // Only add client stats if they exist
        if (isset($data['total_jobs_posted']) && $data['role'] === 'client') {
            $prompt .= "Total Jobs Posted: {$data['total_jobs_posted']}\n";
            $prompt .= "Active Jobs: {$data['active_jobs']}\n";
            $prompt .= "Completed Jobs: {$data['completed_jobs']}\n";
        }

        $prompt .= "\nCreate a professional analysis with these EXACT sections (use numbered format 1., 2., etc.):\n\n";
        $prompt .= "1. Profile Overview - 2-3 sentences summarizing this user's profile and experience\n\n";
        $prompt .= "2. Strengths - Use bullet points (start with -) to list 3-4 positive aspects of this profile\n\n";
        $prompt .= "3. Areas for Improvement - Use bullet points (start with -) to suggest 2-3 ways to enhance the profile\n\n";

        if ($data['role'] === 'freelancer') {
            $prompt .= "4. Work History Insights - Use bullet points to analyze their job completion rate, ratings, and reliability\n\n";
        } else {
            $prompt .= "4. Client Activity - Use bullet points to analyze their job posting patterns and engagement\n\n";
        }

        $prompt .= "FORMATTING RULES:\n";
        $prompt .= "- Use **bold** for emphasis on key points\n";
        $prompt .= "- Start each section with number (1., 2., 3., etc.)\n";
        $prompt .= "- Use - for bullet points\n";
        $prompt .= "- Be professional, objective, and constructive\n";
        $prompt .= "- Keep it concise but informative\n";
        $prompt .= "- Maximum 250 words\n";

        return $prompt;
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
        $prompt .= "Has Social Links: " . ($data['has_social_links'] ?? false ? 'Yes' : 'No') . "\n";

        // Only add freelancer data if it exists
        if (isset($data['completed_jobs']) && $data['role'] === 'freelancer') {
            $prompt .= "Completed Jobs: {$data['completed_jobs']}\n";
            $prompt .= "Average Rating: " . number_format($data['average_rating'], 1) . "/5\n";
            $prompt .= "Total Reviews: {$data['total_reviews']}\n";
        }

        // Only add client data if it exists
        if (isset($data['total_jobs_posted']) && $data['role'] === 'client') {
            $prompt .= "Jobs Posted: {$data['total_jobs_posted']}\n";
            $prompt .= "Completed Projects: {$data['completed_jobs']}\n";
        }

        $prompt .= "\nCRITERIA FOR TRUST SCORE:\n";
        $prompt .= "- Account age (newer = lower trust, 6+ months = higher)\n";
        $prompt .= "- Profile completeness (higher % = higher trust)\n";
        $prompt .= "- Verified contact info and social links (increases trust)\n";
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
        // Extract number from response
        preg_match('/\d+/', $response, $matches);

        if (empty($matches)) {
            return 50; // Default to moderate if parsing fails
        }

        $score = (int) $matches[0];

        // Ensure score is between 0-100
        return max(0, min(100, $score));
    }
}
