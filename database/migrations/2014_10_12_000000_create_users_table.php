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
        // Set the default character set for the database connection
        Schema::defaultStringLength(191); // Adjust to 191 to avoid index issues

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email', 191)->unique();  // Limit length to 191
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('pays')->nullable();
            $table->string('numero')->nullable();
            $table->string('image')->nullable();
            $table->string('genre')->nullable();
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
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
