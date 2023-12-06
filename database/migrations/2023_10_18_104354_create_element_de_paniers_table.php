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
        Schema::create('element_de_paniers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('panier_id');
            $table->foreign('panier_id')->references('id')->on('paniers')->onDelete('cascade');;
            $table->unsignedBigInteger('reservation_id')->nullable(); // Make it nullable
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('element_de_paniers');
    }
};
