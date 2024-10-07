<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('estimate_info', function (Blueprint $table) {
            $table->id(); // This should only be declared once
            $table->string('customer_name')->nullable();
            $table->string('name')->nullable();
            $table->string('creation_date')->nullable();
            $table->string('subject_name')->nullable();
            $table->string('delivery_place')->nullable();
            $table->string('construction_period')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('expiration_date')->nullable();
            $table->text('remarks')->nullable();
            $table->string('charger_name')->nullable();
            $table->string('department_name')->nullable();
            $table->string('construction_name')->nullable();
            $table->string('construction_item')->nullable();
            $table->string('specification')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->text('remarks2')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estimate_info');
    }
};
