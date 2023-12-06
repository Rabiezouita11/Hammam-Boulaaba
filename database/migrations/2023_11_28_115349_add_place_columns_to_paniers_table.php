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
        Schema::table('paniers', function (Blueprint $table) {
            $table->integer('nombre_de_placeAdults')->nullable();
            $table->integer('nombre_de_placeChildren')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paniers', function (Blueprint $table) {
            $table->dropColumn('nombre_de_placeAdults');
            $table->dropColumn('nombre_de_placeChildren');
        });
    }
};
