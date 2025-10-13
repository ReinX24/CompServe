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
        // $clients = User::where('role', 'client')->get();

        $clients = User::where('role', 'client')->get();
        $freelancers = User::where('role', 'freelancer')
            ->pluck('id');

        foreach ($clients as $client) {

            // Open job factories and applications
            $openJobs = JobListing::factory()
                ->count(10)
                ->create([
                    'client_id' => $client->id,
                    'status' => 'open',
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

            // In-progress jobs and accepted applications
            $inProgressJobs = JobListing::factory()
                ->count(10)
                ->create([
                    'client_id' => $client->id,
                    'status' => 'in_progress',
                ]);

            foreach ($inProgressJobs as $job) {
                // Randomly assign one freelancer to the accepted job
                $acceptedFreelancerId = $freelancers->random();

                JobApplication::create([
                    'job_id' => $job->id,
                    'freelancer_id' => $acceptedFreelancerId,
                    'client_id' => $client->id,
                    'status' => 'accepted',
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
