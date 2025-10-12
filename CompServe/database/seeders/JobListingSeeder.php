<?php

namespace Database\Seeders;

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
            JobListing::factory()
                ->count(10)
                ->create([
                    'client_id' => $client->id,
                    'status' => 'open',
                ]);

            // 10 in_progress jobs
            // JobListing::factory()
            //     ->count(10)
            //     ->create([
            //         'client_id' => $client->id,
            //         'status' => 'in_progress',
            //     ]);

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
