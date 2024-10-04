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
        Schema::create('breakdown', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estimate_id')->constrained('estimate_info')->nullable();
            //$table->unsignedBigInteger('estimate_id')->unique();
            //$table->foreignId('construction_id')->constrained('construction_name')->nullable();
            $table->unsignedBigInteger('construction_id')->nullable();
            $table->string('construction_item')->nullable();
            $table->string('specification')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->integer('unit_price')->nullable();
            $table->integer('amount')->nullable();
            $table->text('remarks2')->nullable();
            $table->timestamps();

            // 外部キー制約を追加
            //$table->foreign('estimate_id')->references('id')->on('estimate_info');
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
        Schema::dropIfExists('breakdown');
    }
};
