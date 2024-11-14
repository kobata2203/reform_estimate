<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Departments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Departments')->insert([
            [
                'name' => '本部',
            ],[
                'name' => '契約管理課',
            ],[
                'name' => '営業1課',
            ],[
                'name' => '営業1課3係',
            ],[
                'name' => '営業2課1係',
            ],[
                'name' => '営業3課',
            ]]);
    }
}
