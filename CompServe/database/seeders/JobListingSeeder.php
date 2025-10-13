<?php

namespace Database\Seeders;

use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users with role = 'client'
        $clients = User::where('role', 'client')->get();

        foreach ($clients as $client) {
            // 10 open jobs
            $openJobs = JobListing::factory()
                ->count(10)
                ->create([
                    'client_id' => $client->id,
                    'status' => 'open',
                ]);

            // Add job applications to open job
            // Structure of job application for a job
            // job_id
            // freelancer_id
            // client_id
            // status (pending)
            $openClient = User::where('role', 'client')->first();
            $pendingFreelancers = User::where('role', 'freelancer')->pluck('id');

            // Add job applications to each open job
            foreach ($openJobs as $job) {
                // You can randomize how many freelancers apply per job
                $applicantCount = rand(1, 2); // 2–5 applications per job

                // Randomly select freelancers for this job
                $applicants = $pendingFreelancers->random($applicantCount);

                foreach ($applicants as $freelancerId) {
                    JobApplication::create([
                        'job_id' => $job->id,   // link to the job
                        'freelancer_id' => $freelancerId, // who applied
                        'client_id' => $openClient->id,     // job owner
                        'status' => 'pending',          // still under review
                    ]);
                }
            }

            // 10 in_progress jobs
            // For each JobListing that is in progress, a job application that
            // has the status of accepted must be made
            $inProgressJobs = JobListing::factory()
                ->count(10)
                ->create([
                    'client_id' => $client->id,
                    'status' => 'in_progress',
                ]);

            // Structure of job application that has been accepted for a job
            // job_id
            // freelancer_id
            // client_id
            // status (accepted)
            $client = User::where('role', 'client')->first();
            $freelancer = User::where('role', 'freelancer')->first();

            // For each JobListing that is in progress, create an accepted JobApplication
            foreach ($inProgressJobs as $job) {
                JobApplication::create([
                    'job_id' => $job->id,  // foreign key to job listing
                    'freelancer_id' => $freelancer->id, // freelancer applying
                    'client_id' => $client->id, // client who owns the job
                    'status' => 'accepted', // job is in progress
                ]);
            }

            // 10 completed jobs
            // JobListing::factory()
            //     ->count(10)
            //     ->create([
            //         'client_id' => $client->id,
            //         'status' => 'completed',
            //     ]);
        }
    }
}
