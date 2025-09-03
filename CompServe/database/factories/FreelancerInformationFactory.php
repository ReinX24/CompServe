<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\FreelancerInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

class FreelancerInformationFactory extends Factory
{
    protected $model = FreelancerInformation::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // or overridden in seeder
            'contact_number' => $this->faker->phoneNumber(),
            'about_me' => $this->faker->paragraph(3),

            // Skills → string with comma separated values
            'skills' => implode(',', $this->faker->words(3)),

            // Experiences → JSON encoded array
            'experiences' => [
                [
                    'company' => $this->faker->company(),
                    'job_title' => $this->faker->jobTitle(),
                    'start_date' => $this->faker->date(),
                    'end_date' => $this->faker->date(),
                    'description' => $this->faker->sentence(8),
                ]
            ],

            // Education → JSON encoded array
            'education' => [
                [
                    'school' => $this->faker->company() . ' University',
                    'degree' => $this->faker->randomElement([
                        'Bachelor of Science',
                        'Bachelor of Arts',
                        'Master of Science'
                    ]),
                    'field_of_study' => $this->faker->word() . ' Engineering',
                    'start_year' => (string) $this->faker->year(),
                    'end_year' => (string) $this->faker->year(),
                    'awards' => $this->faker->randomElement([
                        'Consistent Dean\'s Lister',
                        'Magna Cum Laude',
                        'Summa Cum Laude',
                        null
                    ]),
                ]
            ],
        ];
    }
}
