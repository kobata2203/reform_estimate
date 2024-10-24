<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use app\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
        [
            //'id' => 1,
            'name' => '大崎　清和',
            'department_name' => '本部',
            'email' => 'osaki@servantop.co.jp',
            'password' => bcrypt('servan01'),
        ],[
            //'id' => 2,
            'name' => '阪本　眞樹',
            'department_name' => '本部',
            'email' => 'kisama1030@gmail.com',
            'password' => bcrypt('servan01'),
        ],[
            //'id' => 3,
            'name' => '北庄司　拓也',
            'department_name' => '本部',
            'email' => 'kitasyouji01@gmail.com',
            'password' => bcrypt('servan01'),
        ],[
            //'id' => 4,
            'name' => '仲野　亜美',
            'department_name' => '契約管理課',
            'email' => 'a.nakano@servantop.co.jp',
            'password' => bcrypt('servan01'),
        ],[
            //'id' => 5,
            'name' => '安在　宏豊',
            'department_name' => '営業１課',
            'email' => 'honglianzai515@gmail.com',
            'password' => bcrypt('servan01'),
        ],[
            //'id' => 6,
            'name' => '小笹　真貴',
            'department_name' => '契約管理課',
            'email' => 'xxxx@gmail.com',
            'password' => bcrypt('servan01'),
        ],[
            //'id' => 7,
            'name' => '馬場愛和郁',
            'department_name' => '契約管理課',
            'email' => 'babaservan01@gmail.com',
            'password' => bcrypt('servan01'),
        ],[
            //'id' => 8,
            'name' => '杉村　菜摘',
            'department_name' => '契約管理課',
            'email' => 'sugimura.servan01@gmail.com',
            'password' => bcrypt('servan01'),
        ],[
            //'id' => 9,
            'name' => '森垣　日菜子',
            'department_name' => '契約管理課',
            'email' => 'morigaki.servan01@gmail.com',
            'password' => bcrypt('servan01'),
        ],[
            //id' => 10,
            'name' => '野口　莉奈',
            'department_name' => '契約管理課',
            'email' => 'r.noguchi.servan01@gmail.com',
            'password' => bcrypt('servan01'),
        ],[
            //'id' => 11,
            'name' => '渡辺　美那',
            'department_name' => '契約管理課',
            'email' => 'm.watanabe.servan01@gmail.com',
            'password' => bcrypt('servan01'),
        ],[
            //'id' => 12,
            'name' => '宮田　貴子',
            'department_name' => '契約管理課',
            'email' => 't.miyata.servan01@gmail.com',
            'password' => bcrypt('servan01'),
        ]]);
    }
}
