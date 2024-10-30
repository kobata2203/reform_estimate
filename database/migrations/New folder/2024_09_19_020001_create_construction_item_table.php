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
        Schema::create('construction_item', function (Blueprint $table) {
            $table->id('item_id');
            $table->string('item');
            $table->unsignedBigInteger('construction_id')->nullable();
            $table->timestamps();

            // 外部キー制約を追加
            $table->foreign('construction_id')->references('construction_id')->on('construction_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('construction_item');
    }
};
