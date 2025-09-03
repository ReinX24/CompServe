<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\FreelancerInformation;

class FreelancerInformationSeeder extends Seeder
{
    public function run(): void
    {
        // Get all users with role = 'freelancer'
        $freelancers = User::where('role', 'freelancer')->get();

        foreach ($freelancers as $freelancer) {
            FreelancerInformation::factory()->create([
                'user_id' => $freelancer->id,
            ]);
        }
    }
}
