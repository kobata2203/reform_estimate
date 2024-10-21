<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstimatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data to insert into the estimates table
        $estimates = [
            [
                'customer_name' => '株式会社サーバントップ',
                'construction_name' => 'ビルの建設',
                'charger_name' => '山田太郎',
                'department_name' => '営業部',
                'creation_date' => now(),
                'expiration_date' => now()->addDays(30),
            ],
            [
                'customer_name' => 'ABC株式会社',
                'construction_name' => '道路の修理',
                'charger_name' => '佐藤花子',
                'department_name' => '建設部',
                'creation_date' => now(),
                'expiration_date' => now()->addDays(30),
            ],
            [
                'customer_name' => 'XYZ株式会社',
                'construction_name' => '橋の建設',
                'charger_name' => '鈴木一郎',
                'department_name' => '開発部',
                'creation_date' => now(),
                'expiration_date' => now()->addDays(30),
            ],
        ];

        // Insert the data into the estimates table
        DB::table('estimates')->insert($estimates);
    }
}
