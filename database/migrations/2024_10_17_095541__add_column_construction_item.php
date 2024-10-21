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
        Schema::table('construction_item', function($table)
        {
            $table->integer('breakdown_required')->after('construction_id'); // Add the column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('construction_item', function($table)
        {
            $table->dropColumn('breakdown_required'); // Remove the column
        });
    }
};
