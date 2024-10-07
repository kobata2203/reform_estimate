<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breakdown', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estimate_id'); // Use unsignedBigInteger for foreign keys
            $table->unsignedBigInteger('construction_id'); // Foreign key for construction
            $table->string('construction_item')->nullable(); // Changed to only string type
            $table->string('specification')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->integer('unit_price')->nullable();
            $table->integer('amount')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            // Foreign key constraint for estimate_id
            $table->foreign('estimate_id')->references('id')->on('estimate_info')->onDelete('cascade');
            // Foreign key constraint for construction_id
            $table->foreign('construction_id')->references('id')->on('construction')->onDelete('cascade');
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
