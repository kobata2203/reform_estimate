<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class EstimateInfoFactory extends Factory
{
    protected $model = \App\Models\EstimateInfo::class;

    public function definition()
    {
        return [
            'creation_date' => $this->faker->date(),
            'customer_name' => $this->faker->name,
            'construction_name' => $this->faker->word,
            'charger_name' => $this->faker->name,
            'department_name' => $this->faker->word,
        ];
    }
}
