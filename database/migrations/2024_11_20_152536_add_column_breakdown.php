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
            $table->dropColumn('construction_id');
            $table->dropColumn('construction_item');
            $table->dropColumn('specification');
        });

        Schema::table('breakdown', function (Blueprint $table) {
            $table->bigInteger('construction_list_id')->nullable()->comment('工事一覧ID')->after('estimate_id');
        });
        Schema::table('breakdown', function (Blueprint $table) {
            $table->string('construction_name')->nullable()->comment('項目名')->after('construction_list_id');
        });
        Schema::table('breakdown', function (Blueprint $table) {
            $table->string('maker')->nullable()->comment('メーカー名')->after('construction_name');
        });
        Schema::table('breakdown', function (Blueprint $table) {
            $table->string('series_name')->nullable()->comment('シリーズ名（商品名）')->after('maker');
        });
        Schema::table('breakdown', function (Blueprint $table) {
            $table->string('item_number')->nullable()->comment('品番')->after('series_name');
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
            $table->dropColumn('construction_list_id');
            $table->dropColumn('construction_name');
            $table->dropColumn('maker');
            $table->dropColumn('series_name');
            $table->dropColumn('item_number');
        });

        Schema::table('breakdown', function (Blueprint $table) {
            $table->bigInteger('construction_id')->nullable()->after('estimate_id');
            $table->bigInteger('construction_item')->nullable()->after('construction_id');
            $table->string('specification')->nullable()->after('construction_item');
        });
    }
};
