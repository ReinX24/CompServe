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
            // Create 5 jobs for each client
            JobListing::factory()
                ->count(5)
                ->create([
                    'client_id' => $client->id,
                ]);
        }
    }
}
