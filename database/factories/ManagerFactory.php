<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Managerinfo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Managerinfo>
 */
class ManagerFactory extends Factory
{
    protected $model = Managerinfo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(4),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Hash the password
            'department_name' => $this->faker->sentence(3),
        ];
    }
}
