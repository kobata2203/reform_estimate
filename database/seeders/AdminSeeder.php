<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use app\Models\Admin;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
            //'id' => 1,
            'name' => '大崎　清和',
            'department_id' => '1',
            'email' => 'osaki@servantop.co.jp',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
            'role' => User::ROLE_ADMIN,
        ],[
            //'id' => 2,
            'name' => '阪本　眞樹',
            'department_id' => '1',
            'email' => 'kisama1030@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ],[
            //'id' => 3,
            'name' => '北庄司　拓也',
            'department_id' => '1',
            'email' => 'kitasyouji01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ],[
            //'id' => 4,
            'name' => '仲野　亜美',
            'department_id' => '2',
            'email' => 'a.nakano@servantop.co.jp',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ],[
            //'id' => 5,
            'name' => '安在　宏豊',
            'department_id' => '3',
            'email' => 'honglianzai515@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ],[
            //'id' => 6,
            'name' => '小笹　真貴',
            'department_id' => '2',
            'email' => 'ozasa.servan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ],[
            //'id' => 7,
            'name' => '馬場愛和郁',
            'department_id' => '2',
            'email' => 'babaservan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ],[
            //'id' => 8,
            'name' => '杉村　菜摘',
            'department_id' => '2',
            'email' => 'sugimura.servan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ],[
            //'id' => 9,
            'name' => '森垣　日菜子',
            'department_id' => '2',
            'email' => 'morigaki.servan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ],[
            //id' => 10,
            'name' => '野口　莉奈',
            'department_id' => '2',
            'email' => 'r.noguchi.servan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ],[
            //'id' => 11,
            'name' => '渡辺　美那',
            'department_id' => '2',
            'email' => 'm.watanabe.servan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ],[
            //'id' => 12,
            'name' => '宮田　貴子',
            'department_id' => '2',
            'email' => 't.miyata.servan01@gmail.com',
            'password' => bcrypt('servan01'),
            'role' => User::ROLE_ADMIN,
        ]]);
    }
}
