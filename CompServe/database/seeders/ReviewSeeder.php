<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobListing;
use App\Models\JobApplication;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all completed jobs
        $completedJobs = JobListing::where('status', 'completed')->get();

        foreach ($completedJobs as $job) {
            // Find the accepted/completed freelancer for this job
            $application = JobApplication::where('job_id', $job->id)
                ->where('status', 'completed')
                ->first();

            // Only create a review if there's a corresponding completed application
            if ($application) {
                Review::factory()->create([
                    'job_listing_id' => $job->id,
                    'client_id' => $job->client_id,
                    'freelancer_id' => $application->freelancer_id,
                ]);
            }
        }
    }
}
