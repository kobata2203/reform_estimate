<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker; // Correct Faker import

class EstimateInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed estimate_info table with a specific record
        DB::table('estimate_info')->insert([
            [
                'customer_name' => 'テスト　太郎',
                'creation_date' => '2024年08月28日',
                'subject_name' => 'テスト太郎邸　浴室改修工事',
                'delivery_place' => '大阪府堺市北区●●町○ー○○',
                'construction_period' => '約2週間',
                'payment_type' => '現金',
                'expiration_date' => '30日間',
                'remarks' => '工事にかかる電気代・水道代は施主様ご負担になります。現金でのご契約の場合、振込手数料は施主様ご負担になります。',
                'charger_name' => '田中　花子',
                'department_name' => '営業1課',
                'construction_name' => 'テスト太郎邸　浴室改修工事',
                'construction_item' => '既存浴槽解体',
                'specification' => '',
                'quantity' => '1',
                'unit' => '式',
                'unit_price' => '188000',
                'amount' => '188000',
                'remarks2' => '',
                //'construction_id' => '6',
                //construction_name' => '浴室改修工事　※タイル・浴槽',
                //'construction_item' => '既存浴槽解体',
                //'specification' => '',
                //'quantity' => '1',
                //'unit' => '式',
                //'unit_price' => '188000',
                //'amount' => '188000',
                //'remarks2' => '',
            ]
        ]);

        // Seed multiple managers with Faker
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            DB::table('managers')->insert([
               'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'department_name' => $faker->word,
                'construction_name' => $faker->word, // Provide a value here
                'customer_name' => $faker->name,     // Provide a value here
            ]);
        }
        //$faker = Faker::create();
        //foreach (range(1, 10) as $index) {
            //DB::table('managers')->insert([
                //'name' => $faker->name,
                //'email' => $faker->unique()->safeEmail,
                //'password' => Hash::make('password'),
                //'department_name' => $faker->word,
            //]);
        //}
                //'construction_name' => '浴室改修工事',
                //'construction_item' => '既存浴槽解体',
                //'specification' => '',
                //'quantity' => '1',
                //'unit' => '式',
                //'unit_price' => '188000',
                //'amount' => '188000',
                //'remarks2' => '',
            //]]);
    }
}
