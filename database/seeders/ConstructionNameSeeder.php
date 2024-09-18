<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use app\Models\ConstructionName;

class ConstructionNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('construction_name')->insert([
        [
            'id' => '1',
            'construction_name' => '外壁塗装工事a',
        ],[
            'id' => '2',
            'construction_name' => '外壁塗装工事b',
        ],[
            'id' => '3',
            'construction_name' => '外壁重ね張り工事',
        ],[
            'id' => '4',
            'construction_name' => '浴室改修工事　※タイルのみ',
        ],[
            'id' => '5',
            'construction_name' => '浴室改修工事　※バスナフローレのみ',
        ],[
            'id' => '6',
            'construction_name' => '浴室改修工事　※タイル・浴槽',
        ],[
            'id' => '7',
            'construction_name' => '浴室改修工事　※バスナ・浴槽',
        ],[
            'id' => '8',
            'construction_name' => '浴室改修工事　※タイル・浴槽・壁',
        ],[
            'id' => '9',
            'construction_name' => '浴室改修工事　※バスナ・浴槽・壁',
        ],[
            'id' => '10',
            'construction_name' => 'システムバス工事',
        ],[
            'id' => '11',
            'construction_name' => '屋根重ね張り工事',
        ],[
            'id' => '12',
            'construction_name' => '屋根葺き替え工事　※瓦→他',
        ],[
            'id' => '13',
            'construction_name' => '屋根葺き替え工事　※他→他',
        ],[
            'id' => '14',
            'construction_name' => '屋根葺き替え工事　※瓦→瓦',
        ],[
            'id' => '15',
            'construction_name' => '調湿材工事',
        ],[
            'id' => '16',
            'construction_name' => '基礎補強工事　※ベタ基礎の場合',
        ],[
            'id' => '17',
            'construction_name' => '基礎補強工事　※土の場合',
        ],[
            'id' => '18',
            'construction_name' => 'アラミド基礎補強工事　※ベタ基礎の場合',
        ],[
            'id' => '19',
            'construction_name' => 'アラミド基礎補強工事　※土の場合',
        ]]);
    }
}
