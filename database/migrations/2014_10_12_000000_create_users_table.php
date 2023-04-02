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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->string('avatar_image')->default("default.jpg");
            $table->string('national_id')->unique();
            $table->string('email')->unique();
            $table->date("date_of_birth");
            $table->tinyInteger('gender');
            $table->string('phone');
            $table->unsignedBigInteger('pharmacy_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp("deleted_at")->nullable();
            $table->timestamp("last_login")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
