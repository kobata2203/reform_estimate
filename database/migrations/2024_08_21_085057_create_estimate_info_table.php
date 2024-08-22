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
        Schema::create('estimate_info', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->date('creation_date');
            $table->string('subject_name');
            $table->string('delivery_place');
            $table->string('construction_period');
            $table->string('payment_type');
            $table->string('expiration_date');
            $table->text('remarks');
            $table->string('charger_name');
            $table->string('construction_name');
            $table->string('construction_item');
            $table->string('specification');
            $table->integer('quantity');
            $table->string('unit');
            $table->integer('unit_price');
            $table->integer('amount');
            $table->text('remarks2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimate_info');
    }
};
