<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BreakdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('breakdown')->insert([
            [
                'estimate_id' => 1,
                'construction_id' => 1,
                'construction_item' => 'Foundation Work',
                'specification' => 'Concrete Foundation',
                'quantity' => 10,
                'unit' => 'm³',
                'unit_price' => 5000,
                'amount' => 50000,
                'remarks2' => 'Standard concrete foundation',
            ],
            [
                'estimate_id' => 1,
                'construction_id' => 2,
                'construction_item' => 'Electrical Work',
                'specification' => 'Wiring Installation',
                'quantity' => 20,
                'unit' => 'm',
                'unit_price' => 150,
                'amount' => 3000,
                'remarks2' => 'Electrical wiring for the building',
            ],
            [
                'estimate_id' => 1,
                'construction_id' => 3,
                'construction_item' => 'Plumbing Work',
                'specification' => 'Piping',
                'quantity' => 15,
                'unit' => 'm',
                'unit_price' => 300,
                'amount' => 4500,
                'remarks2' => 'Standard PVC piping',
            ],
            [
                'estimate_id' => 1,
                'construction_id' => 4,
                'construction_item' => 'Plumbing Work',
                'specification' => 'Piping',
                'quantity' => 15,
                'unit' => 'm',
                'unit_price' => 300,
                'amount' => 4500,
                'remarks2' => 'Standard PVC piping',
            ],
            [
                'estimate_id' => 1,
                'construction_id' => 5,
                'construction_item' => 'Plumbing Work',
                'specification' => 'Piping',
                'quantity' => 15,
                'unit' => 'm',
                'unit_price' => 300,
                'amount' => 4500,
                'remarks2' => 'Standard PVC piping',
            ],
        ]);
    }
}
