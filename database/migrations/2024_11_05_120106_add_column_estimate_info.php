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
            $table->dropForeign('estimate_info_construction_id_foreign');
            $table->dropColumn('construction_id');
            $table->bigInteger('constructions_id')->nullable()->comment('工事一覧ID')->after('department_name');
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
            $table->dropColumn('constructions_id');
            $table->unsignedBigInteger('construction_id')->default(null)->after('department_name');
            $table->foreign('construction_id')->references('id')->on('construction_name')->OnDelete('cascade');
        });
    }
};
