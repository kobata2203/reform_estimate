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
        Schema::table('construction_item', function (Blueprint $table) {
            $table->dropColumn('default_unit');
        });

        Schema::table('construction_item', function (Blueprint $table) {
            $table->string('maker')->nullable()->comment('メーカー名')->after('construction_id');
        });
        Schema::table('construction_item', function (Blueprint $table) {
            $table->string('series_name')->nullable()->comment('シリーズ名（商品名）')->after('maker');
        });
        Schema::table('construction_item', function (Blueprint $table) {
            $table->string('item_number')->nullable()->comment('品番')->after('series_name');
        });
        Schema::table('construction_item', function (Blueprint $table) {
            $table->integer('quantity')->nullable()->comment('数量')->after('item_number');
        });
        Schema::table('construction_item', function (Blueprint $table) {
            $table->string('unit')->nullable()->comment('単位')->after('quantity');
        });
        Schema::table('construction_item', function (Blueprint $table) {
            $table->text('remarks')->nullable()->comment('備考')->after('unit');
        });
        Schema::table('construction_item', function (Blueprint $table) {
            $table->boolean('maker_required')->nullable(false)->default(0)->comment('メーカー名必須要否')->after('maker');
            $table->boolean('series_name_required')->nullable(false)->default(0)->comment('シリーズ名（商品名）要否')->after('series_name');
            $table->boolean('item_number_required')->nullable(false)->default(0)->comment('品番必須要否')->after('item_number');
            $table->boolean('remarks_required')->nullable(false)->default(0)->comment('備考要否')->after('remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('construction_item', function (Blueprint $table) {
            $table->boolean('default_unit')->nullable(false)->default(0)->after('remarks');
        });

        Schema::table('construction_item', function (Blueprint $table) {
            $table->dropColumn('maker');
            $table->dropColumn('series_name');
            $table->dropColumn('item_number');
            $table->dropColumn('quantity');
            $table->dropColumn('unit');
            $table->dropColumn('remarks');
            $table->dropColumn('maker_required');
            $table->dropColumn('series_name_required');
            $table->dropColumn('item_number_required');
            $table->dropColumn('remarks_required');
        });
    }
};
