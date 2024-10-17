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
        // Clear the table before seeding
        DB::table('estimates')->delete(); // This will delete all records but not reset auto-increment

        // Seed the estimates table with sample data
        DB::table('estimates')->insert([
            [
                'customer_name' => '山田太郎',
                'construction_name' => '外壁塗装工事',
                'charger_name' => '佐藤花子',
                'department_name' => '営業部',
                'creation_date' => '2024-10-01',
                'expiration_date' => '2024-11-01',
            ],
            [
                'customer_name' => '鈴木一郎',
                'construction_name' => '屋根葺き替え工事',
                'charger_name' => '田中美咲',
                'department_name' => '工事部',
                'creation_date' => '2024-10-02',
                'expiration_date' => '2024-11-02',
            ],
            [
                'customer_name' => '高橋健',
                'construction_name' => '浴室改修工事',
                'charger_name' => '山本ゆう',
                'department_name' => '設計部',
                'creation_date' => '2024-10-03',
                'expiration_date' => '2024-11-03',
            ],
            [
                'customer_name' => '高橋',
                'construction_name' => '浴室改修工事',
                'charger_name' => '山本ゆう',
                'department_name' => '設計部',
                'creation_date' => '2024-10-03',
                'expiration_date' => '2024-11-03',
            ],
        ]);
    }
}
