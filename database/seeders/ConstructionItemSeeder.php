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
                'construction_id' => '1'
            ],[
                'item_id' => '2',
                'item' => '養生',
                'construction_id' => '1'
            ],[
                'item_id' => '3',
                'item' => '高圧洗浄',
                'construction_id' => '1'
            ],[
                'item_id' => '4',
                'item' => '下塗り',
                'construction_id' => '1'
            ],[
                'item_id' => '5',
                'item' => '中塗り',
                'construction_id' => '1'
            ],[
                'item_id' => '6',
                'item' => '上塗り',
                'construction_id' => '1'
            ],[
                'item_id' => '7',
                'item' => '付帯塗装',
                'construction_id' => '1'
            ],[
                'item_id' => '8',
                'item' => '目地',
                'construction_id' => '1'
            ],[
                'item_id' => '9',
                'item' => '廃材処分費',
                'construction_id' => '1'
            ],[
                'item_id' => '10',
                'item' => '諸経費',
                'construction_id' => '1'
            ],[
                'item_id' => '11',
                'item' => '仮設足場',
                'construction_id' => '2'
            ],[
                'item_id' => '12',
                'item' => '養生',
                'construction_id' => '2'
            ],[
                'item_id' => '13',
                'item' => '高圧洗浄',
                'construction_id' => '2'
            ],[
                'item_id' => '14',
                'item' => '下塗り',
                'construction_id' => '2'
            ],[
                'item_id' => '15',
                'item' => '中塗り',
                'construction_id' => '2'
            ],[
                'item_id' => '16',
                'item' => '上塗り',
                'construction_id' => '2'
            ],[
                'item_id' => '17',
                'item' => 'ベランダ防水塗装',
                'construction_id' => '2'
            ],[
                'item_id' => '18',
                'item' => '付帯塗装',
                'construction_id' => '2'
            ],[
                'item_id' => '19',
                'item' => '目地',
                'construction_id' => '2'
            ],[
                'item_id' => '20',
                'item' => '廃材処分費',
                'construction_id' => '2'
            ],[
                'item_id' => '21',
                'item' => '諸経費',
                'construction_id' => '2'
            ],[
                'item_id' => '22',
                'item' => '仮設足場',
                'construction_id' => '3'
            ],[
                'item_id' => '23',
                'item' => '下地新設',
                'construction_id' => '3'
            ],[
                'item_id' => '24',
                'item' => '板金貼り',
                'construction_id' => '3'
            ],[
                'item_id' => '25',
                'item' => '各所役物',
                'construction_id' => '3'
            ],[
                'item_id' => '26',
                'item' => '水切り',
                'construction_id' => '3'
            ],[
                'item_id' => '27',
                'item' => '土台水切り',
                'construction_id' => '3'
            ],[
                'item_id' => '28',
                'item' => '各所シーリング',
                'construction_id' => '3'
            ],[
                'item_id' => '29',
                'item' => '廻り縁',
                'construction_id' => '3'
            ],[
                'item_id' => '30',
                'item' => '資材運搬費',
                'construction_id' => '3'
            ],[
                'item_id' => '31',
                'item' => '諸経費',
                'construction_id' => '3'
            ],[
                'item_id' => '32',
                'item' => '既存洗い場タイル解体',
                'construction_id' => '4'
            ],[
                'item_id' => '33',
                'item' => '土間モルタル打ち',
                'construction_id' => '4'
            ],[
                'item_id' => '34',
                'item' => 'タイル貼り付け',
                'construction_id' => '4'
            ],[
                'item_id' => '35',
                'item' => '雑工事',
                'construction_id' => '4'
            ],[
                'item_id' => '36',
                'item' => '廃材処分費',
                'construction_id' => '4'
            ],[
                'item_id' => '37',
                'item' => '諸経費',
                'construction_id' => '4'
            ],[
                'item_id' => '38',
                'item' => '土間モルタル打ち',
                'construction_id' => '5'
            ],[
                'item_id' => '39',
                'item' => 'バスナフローレ貼り付け',
                'construction_id' => '5'
            ],[
                'item_id' => '40',
                'item' => '雑工事',
                'construction_id' => '5'
            ],[
                'item_id' => '41',
                'item' => '廃材処分費',
                'construction_id' => '5'
            ],[
                'item_id' => '42',
                'item' => '諸経費',
                'construction_id' => '5'
            ],[
                'item_id' => '43',
                'item' => '既存洗い場タイル・浴槽解体',
                'construction_id' => '6'
            ],[
                'item_id' => '44',
                'item' => '土間モルタル打ち',
                'construction_id' => '6'
            ],[
                'item_id' => '45',
                'item' => 'タイル貼り付け',
                'construction_id' => '6'
            ],[
                'item_id' => '46',
                'item' => '浴槽取り付け',
                'construction_id' => '6'
            ],[
                'item_id' => '47',
                'item' => '雑工事',
                'construction_id' => '6'
            ],[
                'item_id' => '48',
                'item' => '廃材処分費',
                'construction_id' => '6'
            ],[
                'item_id' => '49',
                'item' => '諸経費',
                'construction_id' => '6'
            ],[
                'item_id' => '50',
                'item' => '既存浴槽解体',
                'construction_id' => '7'
            ],[
                'item_id' => '51',
                'item' => '土間モルタル打ち',
                'construction_id' => '7'
            ],[
                'item_id' => '52',
                'item' => 'バスナフローレ貼り付け',
                'construction_id' => '7'
            ],[
                'item_id' => '53',
                'item' => '浴槽取り付け',
                'construction_id' => '7'
            ],[
                'item_id' => '54',
                'item' => '雑工事',
                'construction_id' => '7'
            ],[
                'item_id' => '55',
                'item' => '廃材処分費',
                'construction_id' => '7'
            ],[
                'item_id' => '56',
                'item' => '諸経費',
                'construction_id' => '7'
            ],[
                'item_id' => '57',
                'item' => '既存洗い場タイル・浴槽解体',
                'construction_id' => '8'
            ],[
                'item_id' => '58',
                'item' => '土間モルタル打ち',
                'construction_id' => '8'
            ],[
                'item_id' => '59',
                'item' => 'タイル貼り付け',
                'construction_id' => '8'
            ],[
                'item_id' => '60',
                'item' => '浴槽取り付け',
                'construction_id' => '8'
            ],[
                'item_id' => '61',
                'item' => '壁パネル貼り付け',
                'construction_id' => '8'
            ],[
                'item_id' => '62',
                'item' => '雑工事',
                'construction_id' => '8'
            ],[
                'item_id' => '63',
                'item' => '廃材処分費',
                'construction_id' => '8'
            ],[
                'item_id' => '64',
                'item' => '諸経費',
                'construction_id' => '8'
            ],[
                'item_id' => '65',
                'item' => '既存浴槽解体',
                'construction_id' => '9'
            ],[
                'item_id' => '66',
                'item' => '土間モルタル打ち',
                'construction_id' => '9'
            ],[
                'item_id' => '67',
                'item' => 'バスナフローレ貼り付け',
                'construction_id' => '9'
            ],[
                'item_id' => '68',
                'item' => '浴槽取り付け',
                'construction_id' => '9'
            ],[
                'item_id' => '69',
                'item' => '壁パネル貼り付け',
                'construction_id' => '9'
            ],[
                'item_id' => '70',
                'item' => '雑工事',
                'construction_id' => '9'
            ],[
                'item_id' => '71',
                'item' => '廃材処分費',
                'construction_id' => '9'
            ],[
                'item_id' => '72',
                'item' => '諸経費',
                'construction_id' => '9'
            ],[
                'item_id' => '73',
                'item' => '既存浴室解体',
                'construction_id' => '10'
            ],[
                'item_id' => '74',
                'item' => '電気工事',
                'construction_id' => '10'
            ],[
                'item_id' => '75',
                'item' => '水道工事',
                'construction_id' => '10'
            ],[
                'item_id' => '76',
                'item' => '土間モルタル打ち',
                'construction_id' => '10'
            ],[
                'item_id' => '77',
                'item' => '防水処理',
                'construction_id' => '10'
            ],[
                'item_id' => '78',
                'item' => 'システムバス',
                'construction_id' => '10'
            ],[
                'item_id' => '79',
                'item' => 'システムバス組み立て',
                'construction_id' => '10'
            ],[
                'item_id' => '80',
                'item' => '大工工事',
                'construction_id' => '10'
            ],[
                'item_id' => '81',
                'item' => '雑工事',
                'construction_id' => '10'
            ],[
                'item_id' => '82',
                'item' => '資材運搬費',
                'construction_id' => '10'
            ],[
                'item_id' => '83',
                'item' => '廃材処分費',
                'construction_id' => '10'
            ],[
                'item_id' => '84',
                'item' => '諸経費',
                'construction_id' => '10'
            ],[
                'item_id' => '85',
                'item' => '仮設足場',
                'construction_id' => '11'
            ],[
                'item_id' => '86',
                'item' => '下地新設',
                'construction_id' => '11'
            ],[
                'item_id' => '87',
                'item' => 'ルーフィング新設',
                'construction_id' => '11'
            ],[
                'item_id' => '88',
                'item' => 'ガルバ新設',
                'construction_id' => '11'
            ],[
                'item_id' => '89',
                'item' => '各所役物',
                'construction_id' => '11'
            ],[
                'item_id' => '90',
                'item' => '各所板金',
                'construction_id' => '11'
            ],[
                'item_id' => '91',
                'item' => '水切り',
                'construction_id' => '11'
            ],[
                'item_id' => '92',
                'item' => '各所シーリング',
                'construction_id' => '11'
            ],[
                'item_id' => '93',
                'item' => '資材運搬費',
                'construction_id' => '11'
            ],[
                'item_id' => '94',
                'item' => '諸経費',
                'construction_id' => '11'
            ],[
                'item_id' => '95',
                'item' => '仮設足場',
                'construction_id' => '12'
            ],[
                'item_id' => '96',
                'item' => '既存屋根材撤去',
                'construction_id' => '12'
            ],[
                'item_id' => '97',
                'item' => '既存土撤去',
                'construction_id' => '12'
            ],[
                'item_id' => '98',
                'item' => '下地新設',
                'construction_id' => '12'
            ],[
                'item_id' => '99',
                'item' => 'ルーフィング新設',
                'construction_id' => '12'
            ],[
                'item_id' => '100',
                'item' => 'ガルバ新設',
                'construction_id' => '12'
            ],[
                'item_id' => '101',
                'item' => '各所役物',
                'construction_id' => '12'
            ],[
                'item_id' => '87',
                'item' => 'ルーフィング新設',
                'construction_id' => '11'
            ],[
                'item_id' => '88',
                'item' => 'ガルバ新設',
                'construction_id' => '11'
            ],[
                'item_id' => '89',
                'item' => '各所役物',
                'construction_id' => '11'
            ],[
                'item_id' => '90',
                'item' => '各所板金',
                'construction_id' => '11'
            ],[
                'item_id' => '91',
                'item' => '水切り',
                'construction_id' => '11'
            ],[
                'item_id' => '92',
                'item' => '各所シーリング',
                'construction_id' => '11'
            ],[
                'item_id' => '93',
                'item' => '資材運搬費',
                'construction_id' => '11'
            ],[
                'item_id' => '94',
                'item' => '諸経費',
                'construction_id' => '11'
            ],[
                'item_id' => '48',
                'item' => 'アラミド繊維貼り付け',
            ]]);

    }
}
