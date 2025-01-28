<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('estimate_calculate', function (Blueprint $table) {

            $table->unsignedBigInteger('construction_list_id')->after('estimate_id');


        });
    }

    public function down()
    {
        Schema::table('estimate_calculate', function (Blueprint $table) {
            $table->dropColumn('construction_list_id');
        });
    }
};
