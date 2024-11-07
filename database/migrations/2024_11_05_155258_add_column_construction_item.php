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
            $table->dropColumn('breakdown_required');
            $table->string('default_unit')->nullable()->comment('デフォルト単位')->after('construction_id');
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
            $table->dropColumn('default_unit');
            $table->integer('breakdown_required')->default(null)->after('construction_id');
        });
    }
};
