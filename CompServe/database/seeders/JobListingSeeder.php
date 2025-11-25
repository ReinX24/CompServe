<?php

namespace Database\Seeders;

use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\User;
use Carbon\Carbon;
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
        $freelancers = User::where('role', 'freelancer')->pluck('id');

        foreach ($clients as $client) {
            /** -------------------------
             *  10 Open Jobs + Applicants
             *  ------------------------- */
            $openJobs = JobListing::factory()
                ->count(10)
                ->create([
                    'client_id' => $client->id,
                    'status' => 'open',
                ]);

            JobListing::factory()
                ->count(10)
                ->create([
                    'client_id' => $client->id,
                    'status' => 'open',
                    'created_at' => Carbon::now(),
                ]);

            foreach ($openJobs as $job) {
                $applicants = $freelancers->random(rand(1, 2));
                foreach ($applicants as $freelancerId) {
                    JobApplication::create([
                        'job_id' => $job->id,
                        'freelancer_id' => $freelancerId,
                        'client_id' => $client->id,
                        'status' => 'pending',
                    ]);
                }
            }

            /** -------------------------
             *  10 In-Progress Jobs
             *  ------------------------- */
            $inProgressJobs = JobListing::factory()
                ->count(10)
                ->create([
                    'client_id' => $client->id,
                    'status' => 'in_progress',
                ]);

            foreach ($inProgressJobs as $job) {
                $acceptedFreelancerId = $freelancers->random();
                JobApplication::create([
                    'job_id' => $job->id,
                    'freelancer_id' => $acceptedFreelancerId,
                    'client_id' => $client->id,
                    'status' => 'accepted',
                ]);
            }

            /** -------------------------
             *  10 In-Progress Jobs with Rejected Applicants
             *  ------------------------- */
            $inProgressRejectedJobs = JobListing::factory()
                ->count(10)
                ->create([
                    'client_id' => $client->id,
                    'status' => 'in_progress',
                ]);

            foreach ($inProgressRejectedJobs as $job) {
                $rejectedFreelancerIds = $freelancers->random(rand(1, 2)); // 1 or 2 rejected applicants
                foreach ($rejectedFreelancerIds as $freelancerId) {
                    JobApplication::create([
                        'job_id' => $job->id,
                        'freelancer_id' => $freelancerId,
                        'client_id' => $client->id,
                        'status' => 'rejected',
                    ]);
                }
            }

            /** -------------------------
             *  10 Cancelled Jobs
             *  ------------------------- */
            $cancelledJobs = JobListing::factory()
                ->count(10)
                ->create([
                    'client_id' => $client->id,
                    'status' => 'cancelled',
                ]);

            foreach ($cancelledJobs as $job) {
                $rejectedFreelancerId = $freelancers->random();
                JobApplication::create([
                    'job_id' => $job->id,
                    'freelancer_id' => $rejectedFreelancerId,
                    'client_id' => $client->id,
                    'status' => 'cancelled',
                ]);
            }

            /** -------------------------
             *  10 Completed Jobs
             *  ------------------------- */
            $completedJobs = JobListing::factory()
                ->count(10)
                ->create([
                    'client_id' => $client->id,
                    'status' => 'completed',
                ]);

            foreach ($completedJobs as $job) {
                $completedFreelancerId = $freelancers->random();
                JobApplication::create([
                    'job_id' => $job->id,
                    'freelancer_id' => $completedFreelancerId,
                    'client_id' => $client->id,
                    'status' => 'completed',
                ]);
            }
        }
    }
}
