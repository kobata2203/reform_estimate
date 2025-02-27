<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ManagerSeeder::class);
        $this->call(ConstructionNameSeeder::class);
        $this->call(ConstructionItemSeeder::class);
        //$this->call(BreakdownSeeder::class);
        $this->call(DepartmentsSeeder::class);
        $this->call(PaymentsSeeder::class);

    }
}
