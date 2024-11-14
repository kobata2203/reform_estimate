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
        Schema::table('estimate_info', function (Blueprint $table) {
            $table->dropColumn('payment_type');
            $table->dropColumn('department_name');
        });
        Schema::table('estimate_info', function (Blueprint $table) {
            $table->bigInteger('payment_id')->nullable()->comment('支払い方法ID')->after('construction_period');
            $table->bigInteger('department_id')->nullable()->comment('部署名ID')->after('charger_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estimate_info', function (Blueprint $table) {
            $table->dropColumn('payment_id');
            $table->dropColumn('department_id');
        });
        Schema::table('estimate_info', function (Blueprint $table) {
            $table->string('payment_type')->nullable()->after('construction_period');
            $table->string('department_name')->nullable()->after('charger_name');
        });
    }
};

