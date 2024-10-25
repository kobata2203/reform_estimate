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
                'item_id' => '102',
                'item' => '各所板金',
                'construction_id' => '12'
            ],[
                'item_id' => '103',
                'item' => '水切り',
                'construction_id' => '12'
            ],[
                'item_id' => '104',
                'item' => '各所シーリング',
                'construction_id' => '12'
            ],[
                'item_id' => '105',
                'item' => '資材運搬費',
                'construction_id' => '12'
            ],[
                'item_id' => '106',
                'item' => '廃材処分費',
                'construction_id' => '12'
            ],[
                'item_id' => '107',
                'item' => '諸経費',
                'construction_id' => '12'
            ],[
                'item_id' => '108',
                'item' => '仮設足場',
                'construction_id' => '13'
            ],[
                'item_id' => '109',
                'item' => '既存屋根材撤去',
                'construction_id' => '13'
            ],[
                'item_id' => '110',
                'item' => '下地新設',
                'construction_id' => '13'
            ],[
                'item_id' => '111',
                'item' => 'ルーフィング新設',
                'construction_id' => '13'
            ],[
                'item_id' => '112',
                'item' => 'ガルバ新設',
                'construction_id' => '13'
            ],[
                'item_id' => '113',
                'item' => '各所役物',
                'construction_id' => '13'
            ],[
                'item_id' => '114',
                'item' => '各所板金',
                'construction_id' => '13'
            ],[
                'item_id' => '115',
                'item' => '水切り',
                'construction_id' => '13'
            ],[
                'item_id' => '116',
                'item' => '各所シーリング',
                'construction_id' => '13'
            ],[
                'item_id' => '117',
                'item' => '資材運搬費',
                'construction_id' => '13'
            ],[
                'item_id' => '118',
                'item' => '廃材処分費',
                'construction_id' => '13'
            ],[
                'item_id' => '119',
                'item' => '諸経費',
                'construction_id' => '13'
            ],[
                'item_id' => '120',
                'item' => '仮設足場',
                'construction_id' => '14'
            ],[
                'item_id' => '121',
                'item' => '既存屋根材撤去',
                'construction_id' => '14'
            ],[
                'item_id' => '122',
                'item' => '既存土撤去',
                'construction_id' => '14'
            ],[
                'item_id' => '123',
                'item' => '下地新設',
                'construction_id' => '14'
            ],[
                'item_id' => '124',
                'item' => 'ルーフィング新設',
                'construction_id' => '14'
            ],[
                'item_id' => '125',
                'item' => '瓦新設',
                'construction_id' => '14'
            ],[
                'item_id' => '126',
                'item' => '各所役物',
                'construction_id' => '14'
            ],[
                'item_id' => '127',
                'item' => '各所板金',
                'construction_id' => '14'
            ],[
                'item_id' => '128',
                'item' => '水切り',
                'construction_id' => '14'
            ],[
                'item_id' => '129',
                'item' => '各所シーリング',
                'construction_id' => '14'
            ],[
                'item_id' => '130',
                'item' => '資材運搬費',
                'construction_id' => '14'
            ],[
                'item_id' => '131',
                'item' => '廃材処分費',
                'construction_id' => '14'
            ],[
                'item_id' => '132',
                'item' => '諸経費',
                'construction_id' => '14'
            ],[
                'item_id' => '133',
                'item' => '床下整地',
                'construction_id' => '15'
            ],[
                'item_id' => '134',
                'item' => '調湿材',
                'construction_id' => '15'
            ],[
                'item_id' => '135',
                'item' => '資材運搬費',
                'construction_id' => '15'
            ],[
                'item_id' => '136',
                'item' => '諸経費',
                'construction_id' => '15'
            ],[
                'item_id' => '137',
                'item' => '基礎扱きケレン作業',
                'construction_id' => '16'
            ],[
                'item_id' => '138',
                'item' => 'タックダイン塗布',
                'construction_id' => '16'
            ],[
                'item_id' => '139',
                'item' => 'タックダイン塗布（2回目）',
                'construction_id' => '16'
            ],[
                'item_id' => '140',
                'item' => '資材運搬費',
                'construction_id' => '16'
            ],[
                'item_id' => '141',
                'item' => '諸経費',
                'construction_id' => '16'
            ],[
                'item_id' => '142',
                'item' => '基礎扱きケレン作業',
                'construction_id' => '17'
            ],[
                'item_id' => '143',
                'item' => '立ち上がり部分彫り込み',
                'construction_id' => '17'
            ],[
                'item_id' => '144',
                'item' => 'タックダイン塗布',
                'construction_id' => '17'
            ],[
                'item_id' => '145',
                'item' => 'タックダイン塗布（2回目）',
                'construction_id' => '17'
            ],[
                'item_id' => '146',
                'item' => '資材運搬費',
                'construction_id' => '17'
            ],[
                'item_id' => '147',
                'item' => '諸経費',
                'construction_id' => '17'
            ],[
                'item_id' => '148',
                'item' => '基礎扱きケレン作業',
                'construction_id' => '18'
            ],[
                'item_id' => '149',
                'item' => 'タックダイン塗布',
                'construction_id' => '18'
            ],[
                'item_id' => '150',
                'item' => 'アラミド繊維貼り付け',
                'construction_id' => '18'
            ],[
                'item_id' => '151',
                'item' => 'タックダイン塗布（2回目）',
                'construction_id' => '18'
            ],[
                'item_id' => '152',
                'item' => '資材運搬費',
                'construction_id' => '18'
            ],[
                'item_id' => '153',
                'item' => '諸経費',
                'construction_id' => '18'
            ],[
                'item_id' => '154',
                'item' => '基礎扱きケレン作業',
                'construction_id' => '19'
            ],[
                'item_id' => '155',
                'item' => '立ち上がり部分彫り込み',
                'construction_id' => '19'
            ],[
                'item_id' => '156',
                'item' => 'タックダイン塗布',
                'construction_id' => '19'
            ],[
                'item_id' => '157',
                'item' => 'アラミド繊維貼り付け',
                'construction_id' => '19'
            ],[
                'item_id' => '158',
                'item' => 'タックダイン塗布（2回目）',
                'construction_id' => '19'
            ],[
                'item_id' => '159',
                'item' => '資材運搬費',
                'construction_id' => '19'
            ],[
                'item_id' => '160',
                'item' => '諸経費',
                'construction_id' => '19'
            ]]);

    }
}
