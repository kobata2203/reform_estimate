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
        Schema::table('breakdown', function (Blueprint $table) {
            $table->boolean('delete_flag')->nullable(false)->default(0)->comment('削除フラグ')->after('remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('breakdown', function (Blueprint $table) {
            $table->dropColumn('delete_flag');
        });
    }
};
