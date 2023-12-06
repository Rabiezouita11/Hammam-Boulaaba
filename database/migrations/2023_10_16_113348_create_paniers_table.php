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
        Schema::create('paniers', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->unsignedBigInteger('service_id'); // Foreign key to link with service table
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');;
            $table->integer('nombre_de_place');
            $table->decimal('montant_total', 10, 2);
            $table->datetime('start');
            $table->string('status')->default('new'); // Add a 'status' column with a default value of 'new'
            $table->datetime('end'); // Decimal data type with 10 digits and 2 decimal places
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paniers');
    }
};
