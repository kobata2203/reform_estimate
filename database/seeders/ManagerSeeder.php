<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Managerinfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void
    {
        // Check if the record already exists
        $existingManager = DB::table('managers')->where('email', 'john.doe@example.com')->first();

        // Insert only if the record doesn't exist
        if (!$existingManager) {
            DB::table('managers')->insert([
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
               'password' => bcrypt('password'), // Ensure you use appropriate hashing
                'department_name' => 'Sales',
            ]);
        }

        // Create 10 unique Managerinfo records using the factory
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('managers')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,  // Ensures unique emails
                'password' => Hash::make('password'),
                'department_name' => $faker->company,
            ]);
        }

        // Create 10 Managerinfo records using the factory
        Managerinfo::factory(10)->create();
    }
}
