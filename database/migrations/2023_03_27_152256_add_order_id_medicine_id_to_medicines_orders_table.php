<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('medicines_orders', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders');

            $table->foreign('medicine_id')->references('id')->on('medicines');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicines_orders', function (Blueprint $table) {
            //
        });
    }
};
