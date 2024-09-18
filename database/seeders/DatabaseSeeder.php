<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders;
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
        $this->call(EstimateInfoSeeder::class);
        $this->call(ManagerSeeder::class);
<<<<<<< HEAD
        $this->call(EstimateInfoSeeder::class);
=======
        $this->call(ConstructionNameSeeder::class);
>>>>>>> 77cf654eba123dafc4e50cdcfded18a332b3b0f6
    }
}
