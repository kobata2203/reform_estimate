<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('estimate_info', function (Blueprint $table) {
            $table->id();
            $table->string('construction_name');
            $table->string('customer_name')->nullable();
            // $table->string('name')->nullable();
            $table->string('creation_date')->nullable();
            $table->string('subject_name')->nullable();
            $table->string('delivery_place')->nullable();
            $table->string('construction_period')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('expiration_date')->nullable();
            $table->text('remarks')->nullable();
            $table->string('charger_name')->nullable();
            $table->string('department_name')->nullable();
            $table->unsignedBigInteger('construction_id')->nullable();

            $table->boolean('is_deleted')->default(false);

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('construction_id')->references('construction_id')->on('construction_name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('estimate_info');
    }
};
