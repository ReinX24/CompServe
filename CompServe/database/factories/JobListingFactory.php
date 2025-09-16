<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListing>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // client_id will be assigned in seeder so it always belongs to a client user
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(5),
            'category' => $this->faker->randomElement(['Hardware', 'DesktopComputers', 'LaptopComputers', 'MobilePhones', 'Accessories', 'Networking']),
            'skills_required' => $this->faker->randomElements(
                ['PHP', 'Laravel', 'React', 'Vue', 'Node.js', 'Figma', 'SEO', 'Content Writing'],
                3
            ),
            'budget_type' => $this->faker->randomElement(['fixed', 'hourly']),
            'budget' => $this->faker->randomFloat(2, 100, 5000),
            'location' => $this->faker->city(),
            'deadline' => $this->faker->dateTimeBetween('now', '+3 months'),
            'status' => $this->faker->randomElement(['open', 'in_progress', 'completed']),
        ];
    }
}
