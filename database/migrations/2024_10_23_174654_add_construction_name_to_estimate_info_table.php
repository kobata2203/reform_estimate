<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstructionNameToEstimateInfoTable extends Migration
{
    public function up()
    {
        Schema::table('estimate_info', function (Blueprint $table) {
            $table->string('construction_name')->nullable(); // Add the column here
        });
    }

    public function down()
    {
        Schema::table('estimate_info', function (Blueprint $table) {
            $table->dropColumn('construction_name'); // Drop the column if rollback
        });
    }
}

