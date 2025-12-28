<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AiSummaryController extends Controller
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
}
