<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Managerinfo;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void
    {
        DB::table('managers')->insert([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password'),
            'department_name' => 'Sales',
        // Create 10 Managerinfo records
        Managerinfo::factory(10)->create();
    }
}
