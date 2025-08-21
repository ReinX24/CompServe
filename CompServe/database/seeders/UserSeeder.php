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
    }
}
