<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 10 Admins
        // User::factory()->count(10)->create([
        //     'role' => 'admin',
        // ]);

        // 10 Freelancers
        // User::factory()->count(10)->create([
        //     'role' => 'freelancer',
        // ]);

        // 10 Clients
        // User::factory()->count(10)->create([
        //     'role' => 'client',
        // ]);

        // Freelancer account for testing
        User::factory()->create([
            'name' => 'Freelancer1',
            'email' => 'freelancer1@example.com',
            'password' => 'password',
            'role' => 'freelancer',
        ]);

        User::factory()->create([
            'name' => 'Freelancer2',
            'email' => 'freelancer2@example.com',
            'password' => 'password',
            'role' => 'freelancer',
            'created_at' => Carbon::now()->addDays(10),
        ]);

        User::factory()->create([
            'name' => 'Freelancer3',
            'email' => 'freelancer3@example.com',
            'password' => 'password',
            'role' => 'freelancer',
            'created_at' => Carbon::now()->addMonth(),
        ]);

        // Client account for testing
        User::factory()->create([
            'name' => 'Client1',
            'email' => 'client1@example.com',
            'password' => 'password',
            'role' => 'client',
        ]);

        User::factory()->create([
            'name' => 'Client2',
            'email' => 'client2@example.com',
            'password' => 'password',
            'role' => 'client',
            'created_at' => Carbon::now()->addDays(10),
        ]);

        User::factory()->create([
            'name' => 'Client3',
            'email' => 'client3@example.com',
            'password' => 'password',
            'role' => 'client',
            'created_at' => Carbon::now()->addMonth(),
        ]);

        // Admin account for testing
        User::factory()->create([
            'name' => 'Admin1',
            'email' => 'admin1@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);
    }
}
