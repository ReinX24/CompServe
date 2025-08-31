<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()->count(10)->create([
            'role' => 'admin',
        ]);

        // 10 Freelancers
        User::factory()->count(10)->create([
            'role' => 'freelancer',
        ]);

        // 10 Clients
        User::factory()->count(10)->create([
            'role' => 'client',
        ]);

        // Freelancer account for testing
        User::factory()->create([
            'name' => 'Freelancer1',
            'email' => 'freelancer1@example.com',
            'password' => 'password',
            'role' => 'freelancer',
        ]);

        // Client account for testing
        User::factory()->create([
            'name' => 'Client1',
            'email' => 'client1@example.com',
            'password' => 'password',
            'role' => 'client',
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
