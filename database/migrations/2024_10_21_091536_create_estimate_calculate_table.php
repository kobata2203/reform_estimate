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
        Schema::create('estimate_calculate', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('estimate_id'); // Foreign key to estimates
            $table->integer('special_discount'); // Special discount amount
            $table->integer('subtotal_price'); // Subtotal amount before tax
            $table->integer('consumption_tax'); // Consumption tax amount
            $table->integer('total_price'); // Total amount including tax
            $table->timestamps(); // Created at and updated at timestamps

            // Set the foreign key constraint
            $table->foreign('estimate_id')->references('id')->on('estimates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimate_calculate'); 
    }
};
