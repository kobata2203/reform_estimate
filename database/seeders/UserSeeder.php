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
        DB::table('users')->insert([
            [
                'name' => '阪本　眞樹',
                'department_id' => '1',
                'email' => 'kisama1030@gmail.com',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '北庄司　拓也',
                'department_id' => '1',
                'email' => 'kitasyouji01@gmail.com',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '樫本　一馬',
                'department_id' => '6',
                'email' => 'kashimoto.servan01@gmail.com',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '安在　宏豊',
                'department_id' => '3',
                'email' => 'honglianzai515@gmail.com',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '坂本　悠一郎',
                'department_id' => '4',
                'email' => 'y.sakamoto.servan01@gmail.com',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '藤井　渉',
                'department_id' => '4',
                'email' => 'w8666265@gmail.com',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '小嶋　潤',
                'department_id' => '5',
                'email' => 'junkojima0613@gmail.com',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '大森　翔平',
                'department_id' => '4',
                'email' => 'rittt45wohf@gmail.com',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '矢ヶ崎　陽太',
                'department_id' => '4',
                'email' => 'freedom-life_fca37@i.softbank.jp',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '瓦谷　大樹',
                'department_id' => '7',
                'email' => 'hiroki.1018.www@icloud.com',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '竹部　貞秀',
                'department_id' => '7',
                'email' => 'servantop.takebe0804@gmail.com',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '天野　裕二',
                'department_id' => '5',
                'email' => 'amano.servan01@gmail.com',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '大霜　浩斗',
                'department_id' => '4',
                'email' => 'h.oshimo.servan01@gmail.com',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '南園　康友',
                'department_id' => '5',
                'email' => 'k.minamizono.servan01@gmail.com',
                'password' => bcrypt('servan01'),
            ],[
                'name' => '塩見　俊也',
                'department_id' => '7',
                'email' => 's.shiomi.servan01@gmail.com',
                'password' => bcrypt('servan01'),
            ]]);
    }
}
