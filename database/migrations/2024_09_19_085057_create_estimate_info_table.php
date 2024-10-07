<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimateInfoTable extends Migration
{
    public function up()
    {
        Schema::create('estimate_info', function (Blueprint $table) {
            $table->id();
            $table->string('construction_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estimate_info');
    }
}
