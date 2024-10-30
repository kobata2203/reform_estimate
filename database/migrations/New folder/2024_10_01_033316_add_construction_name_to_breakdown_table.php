<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstructionNameToBreakdownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('breakdown', 'construction_name')) {
            Schema::table('breakdown', function (Blueprint $table) {
                $table->string('construction_name')->nullable(); // Add the column
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('breakdown', 'construction_name')) {
            Schema::table('breakdown', function (Blueprint $table) {
                $table->dropColumn('construction_name'); // Remove the column
            });
        }
    }
}
