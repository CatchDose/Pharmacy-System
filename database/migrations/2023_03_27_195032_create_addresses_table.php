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
        Schema::create('addresses', function (Blueprint $table) {

            $table->id();
            $table->string("street_name");
            $table->string("building_number");
            $table->string("floor_number");
            $table->string("flat_number");
            $table->boolean("is_main");
            $table->unsignedBigInteger("area_id");
            $table->unsignedBigInteger("user_id");
            $table->timestamps();
            $table->timestamp("deleted_at")->nullable();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('user_id')->references('id')->on('users');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
