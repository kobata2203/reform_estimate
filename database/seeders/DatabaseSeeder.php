<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders;
use Database\ManagerSeeders;
use App\Models\Managerinfo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ManagerSeeder::class);
        $this->call(ConstructionNameSeeder::class);
        $this->call(ConstructionItemSeeder::class);
        $this->call(BreakdownSeeder::class);
    }
}
