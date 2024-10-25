<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use app\Models\Breakdown;

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

                'estimate_id' => '3',
                'construction_id' => '1',
                'construction_item' => '仮設足場',
                'specification' => '',
                'quantity' => '1',
                'unit' => '式',
                'unit_price' => '50000',
                'amount' => '50000',
                'remarks' => '',
            ],[

                'estimate_id' => '1',
                'construction_id' => '1',
                'construction_item' => '養生',
                'specification' => '',
                'quantity' => '1',
                'unit' => '式',
                'unit_price' => '50000',
                'amount' => '50000',
                'remarks' => '',
            ],[

                'estimate_id' => '1',
                'construction_id' => '1',
                'construction_item' => '高圧洗浄',
                'specification' => '',
                'quantity' => '1',
                'unit' => '式',
                'unit_price' => '50000',
                'amount' => '50000',
                'remarks' => '',
            ],[

                'estimate_id' => '1',
                'construction_id' => '1',
                'construction_item' => '下塗り',
                'specification' => '',
                'quantity' => '1',
                'unit' => '式',
                'unit_price' => '50000',
                'amount' => '50000',
                'remarks' => '',
            ],[

                'estimate_id' => '1',
                'construction_id' => '1',
                'construction_item' => '中塗り',
                'specification' => '',
                'quantity' => '1',
                'unit' => '式',
                'unit_price' => '50000',
                'amount' => '50000',
                'remarks' => '',
            ],[

                'estimate_id' => '1',
                'construction_id' => '1',
                'construction_item' => '上塗り',
                'specification' => '',
                'quantity' => '1',
                'unit' => '式',
                'unit_price' => '50000',
                'amount' => '50000',
                'remarks' => '',
            ],[

                'estimate_id' => '1',
                'construction_id' => '1',
                'construction_item' => '付帯塗装',
                'specification' => '',
                'quantity' => '1',
                'unit' => '式',
                'unit_price' => '50000',
                'amount' => '50000',
                'remarks' => '',
            ],[

                'estimate_id' => '1',
                'construction_id' => '1',
                'construction_item' => '目地',
                'specification' => '',
                'quantity' => '1',
                'unit' => '式',
                'unit_price' => '50000',
                'amount' => '50000',
                'remarks' => '',
            ],[

                'estimate_id' => '1',
                'construction_id' => '1',
                'construction_item' => '廃材処分費',
                'specification' => '',
                'quantity' => '1',
                'unit' => '式',
                'unit_price' => '50000',
                'amount' => '50000',
                'remarks' => '',
            ],[

                'estimate_id' => '1',
                'construction_id' => '1',
                'construction_item' => '諸経費',
                'specification' => '',
                'quantity' => '1',
                'unit' => '式',
                'unit_price' => '50000',
                'amount' => '50000',
                'remarks' => '',
            ]]);
    }
}
