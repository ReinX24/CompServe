<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(UserSeeder::class);

        // Create 3 users, 1 for admin, 2 for client, and 2 for freelancer
        User::factory()->create([
            'name' => 'Client1',
            'email' => 'client1@example.com',
            'password' => 'password',
            'role' => 'client'
        ]);

        User::factory()->create([
            'name' => 'Client2',
            'email' => 'client2@example.com',
            'password' => 'password',
            'role' => 'client'
        ]);

        User::factory()->create([
            'name' => 'Freelancer1',
            'email' => 'freelancer1@example.com',
            'password' => 'password',
            'role' => 'freelancer'
        ]);

        User::factory()->create([
            'name' => 'Freelancer2',
            'email' => 'freelancer2@example.com',
            'password' => 'password',
            'role' => 'freelancer'
        ]);

        User::factory()->create([
            'name' => 'Admin1',
            'email' => 'admin1@example.com',
            'password' => 'password',
            'role' => 'admin'
        ]);

        // $this->call(JobListingSeeder::class);

        // Create 3 jobs, open, in_progress, and completed

        // $this->call(FreelancerInformationSeeder::class);
    }
}
