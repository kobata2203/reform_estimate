<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Managerinfo; // Ensure this is the correct model

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Managerinfo>
 */
class ManagerinfoFactory extends Factory
{
    protected $model = Managerinfo::class; // Ensure this is the correct model

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition():array
    {
        return [
            'name' => fake()->sentence(4),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Hash the password
            'department_name' => fake()->sentence(3),
            'construction_name' => $this->faker->word,
        ];
    }
}
