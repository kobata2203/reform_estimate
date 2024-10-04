<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use app\Models\ConstructionItem;

class ConstructionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('construction_item')->insert([
            [
                'item_id' => '1',
                'item' => '仮設足場',
            ],[
                'item_id' => '2',
                'item' => '養生',
            ],[
                'item_id' => '3',
                'item' => '高圧洗浄',
            ],[
                'item_id' => '4',
                'item' => '下塗り',
            ],[
                'item_id' => '5',
                'item' => '中塗り',
            ],[
                'item_id' => '6',
                'item' => '上塗り',
            ],[
                'item_id' => '7',
                'item' => 'ベランダ防水塗装',
            ],[
                'item_id' => '8',
                'item' => '付帯塗装',
            ],[
                'item_id' => '9',
                'item' => '目地',
            ],[
                'item_id' => '10',
                'item' => '廃材処分費',
            ],[
                'item_id' => '11',
                'item' => '諸経費',
            ],[
                'item_id' => '12',
                'item' => '下地新設',
            ],[
                'item_id' => '13',
                'item' => '板金貼り',
            ],[
                'item_id' => '14',
                'item' => '各所役物',
            ],[
                'item_id' => '15',
                'item' => '水切り',
            ],[
                'item_id' => '16',
                'item' => '土台水切り',
            ],[
                'item_id' => '17',
                'item' => '各所シーリング',
            ],[
                'item_id' => '18',
                'item' => '廻り縁',
            ],[
                'item_id' => '19',
                'item' => '資材運搬費',
            ],[
                'item_id' => '20',
                'item' => '既存洗い場タイル解体',
            ],[
                'item_id' => '21',
                'item' => '土間モルタル打ち',
            ],[
                'item_id' => '22',
                'item' => 'タイル貼り付け',
            ],[
                'item_id' => '23',
                'item' => '雑工事',
            ],[
                'item_id' => '24',
                'item' => 'バスナフローレ貼り付け',
            ],[
                'item_id' => '25',
                'item' => '既存洗い場タイル・浴槽解体',
            ],[
                'item_id' => '26',
                'item' => '浴槽取り付け',
            ],[
                'item_id' => '27',
                'item' => '既存浴槽解体',
            ],[
                'item_id' => '28',
                'item' => '壁パネル貼り付け',
            ],[
                'item_id' => '29',
                'item' => '電気工事',
            ],[
                'item_id' => '30',
                'item' => '水道工事',
            ],[
                'item_id' => '31',
                'item' => '防水処理',
            ],[
                'item_id' => '32',
                'item' => 'システムバス',
            ],[
                'item_id' => '33',
                'item' => 'システムバス組み立て',
            ],[
                'item_id' => '34',
                'item' => '大工工事',
            ],[
                'item_id' => '35',
                'item' => 'ルーフィング新設',
            ],[
                'item_id' => '36',
                'item' => 'ガルバ新設',
            ],[
                'item_id' => '37',
                'item' => '各所板金',
            ],[
                'item_id' => '38',
                'item' => '既存屋根材撤去',
            ],[
                'item_id' => '39',
                'item' => '既存土撤去',
            ],[
                'item_id' => '40',
                'item' => 'ガルバ新設・カラーベスト新設',
            ],[
                'item_id' => '41',
                'item' => '瓦新設',
            ],[
                'item_id' => '42',
                'item' => '床下整地',
            ],[
                'item_id' => '43',
                'item' => '調湿材',
            ],[
                'item_id' => '44',
                'item' => '基礎扱きケレン作業',
            ],[
                'item_id' => '45',
                'item' => 'タックダイン塗布',
            ],[
                'item_id' => '46',
                'item' => 'タックダイン塗布（2回目）',
            ],[
                'item_id' => '47',
                'item' => '立ち上がり部分彫り込み',
            ],[
                'item_id' => '48',
                'item' => 'アラミド繊維貼り付け',
            ]]);

    }
}
