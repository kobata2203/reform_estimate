<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estimate_info', function (Blueprint $table) {
            $table->dropColumn('delet_flag');
            $table->boolean('delete_flag')->nullable(false)->default(0)->comment('削除フラグ')->after('construction_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estimate_info', function (Blueprint $table) {
            $table->dropColumn('delete_flag');
            $table->boolean('delet_flag')->default(false)->after('construction_id');
        });
    }
};
