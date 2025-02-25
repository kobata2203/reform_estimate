<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use app\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ADMIN ---------------------------------
        User::factory(1)->create([
            //'id' => 1,
            'name' => '大崎　清和',
            'department_id' => '1',
            'email' => 'osaki@servantop.co.jp',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory(1)->create([
            //'id' => 2,
            'name' => '阪本　眞樹',
            'department_id' => '1',
            'email' => 'kisama1030@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory(1)->create([
            //'id' => 3,
            'name' => '北庄司　拓也',
            'department_id' => '1',
            'email' => 'kitasyouji01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory(1)->create([
            //'id' => 4,
            'name' => '仲野　亜美',
            'department_id' => '2',
            'email' => 'a.nakano@servantop.co.jp',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory(1)->create([
            //'id' => 5,
            'name' => '安在　宏豊',
            'department_id' => '3',
            'email' => 'honglianzai515@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory(1)->create([
            //'id' => 6,
            'name' => '小笹　真貴',
            'department_id' => '2',
            'email' => 'ozasa.servan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory(1)->create([
            //'id' => 7,
            'name' => '馬場愛和郁',
            'department_id' => '2',
            'email' => 'babaservan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory(1)->create([
            //'id' => 8,
            'name' => '杉村　菜摘',
            'department_id' => '2',
            'email' => 'sugimura.servan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory(1)->create([
            //'id' => 9,
            'name' => '森垣　日菜子',
            'department_id' => '2',
            'email' => 'morigaki.servan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory(1)->create([
            //id' => 10,
            'name' => '野口　莉奈',
            'department_id' => '2',
            'email' => 'r.noguchi.servan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory(1)->create([
            //'id' => 11,
            'name' => '渡辺　美那',
            'department_id' => '2',
            'email' => 'm.watanabe.servan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory(1)->create([
            //'id' => 12,
            'name' => '宮田　貴子',
            'department_id' => '2',
            'email' => 't.miyata.servan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ]);        

        User::factory(1)->create([
            //'id' => 12,
            'name' => '宮里　ウェリントン',
            'department_id' => '1',
            'email' => 'admin@admin.com',
            'role' => User::ROLE_ADMIN,
        ]);
        User::factory(1)->create([
            //'id' => 12,
            'name' => '宮里　アケミ',
            'department_id' => '1',
            'email' => 'user@user.com',
            'role' => User::ROLE_SALES,
        ]);
        // ADMIN ---------------------------------

        // SALES --------------------------------
        DB::table('users')->insert([
            [
                'name' => '阪本　眞樹',
                'department_id' => '1',
                'email' => 'kisama1030@gmail.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '北庄司　拓也',
                'department_id' => '1',
                'email' => 'kitasyouji01@gmail.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '樫本　一馬',
                'department_id' => '6',
                'email' => 'kashimoto.servan01@gmail.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '安在　宏豊',
                'department_id' => '3',
                'email' => 'honglianzai515@gmail.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '坂本　悠一郎',
                'department_id' => '4',
                'email' => 'y.sakamoto.servan01@gmail.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '藤井　渉',
                'department_id' => '4',
                'email' => 'w8666265@gmail.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '小嶋　潤',
                'department_id' => '5',
                'email' => 'junkojima0613@gmail.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '大森　翔平',
                'department_id' => '4',
                'email' => 'rittt45wohf@gmail.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '矢ヶ崎　陽太',
                'department_id' => '4',
                'email' => 'freedom-life_fca37@i.softbank.jp',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '瓦谷　大樹',
                'department_id' => '7',
                'email' => 'hiroki.1018.www@icloud.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '竹部　貞秀',
                'department_id' => '7',
                'email' => 'servantop.takebe0804@gmail.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '天野　裕二',
                'department_id' => '5',
                'email' => 'amano.servan01@gmail.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '大霜　浩斗',
                'department_id' => '4',
                'email' => 'h.oshimo.servan01@gmail.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '南園　康友',
                'department_id' => '5',
                'email' => 'k.minamizono.servan01@gmail.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ],[
                'name' => '塩見　俊也',
                'department_id' => '7',
                'email' => 's.shiomi.servan01@gmail.com',
                'password' => bcrypt('servan01'),
                'role' => User::ROLE_SALES,
            ]
        ]);
        // SALES --------------------------------
        
    
        
    }

}
