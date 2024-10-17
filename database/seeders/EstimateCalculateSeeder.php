<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstimateCalculateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estimate_calculate')->insert([
            [
                'estimate_id' => 1,  // Ensure this matches an existing estimate ID
                'special_discount' => 1000,
                'subtotal_price' => 21000,
                'consumption_tax' => 2100,
                'total_price' => 23100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
            [
                'estimate_id' => 2,  // Ensure this matches an existing estimate ID
                'special_discount' => 500,
                'subtotal_price' => 15000,
                'consumption_tax' => 1500,
                'total_price' => 16500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // You can add more entries if needed
        ]);
    }
}
