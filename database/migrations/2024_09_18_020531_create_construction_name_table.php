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
        Schema::create('construction_name', function (Blueprint $table) {
            $table->id('construction_id');
            $table->string('construction_name');
            $table->integer('loop_count');
            $table->timestamps();

            //$table->foreign('construction_id')->references('construction_id')->on('estimate_info');
            //$table->foreign('construction_name')->references('construction_name')->on('estimate_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('construction_name');
    }
};
