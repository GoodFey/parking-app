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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')->constrained('clients');
            $table->tinyText('brand');
            $table->tinyText('model');
            $table->tinyText('color_of_carcass');
            $table->bigInteger('gos_number')->unique();
            $table->boolean('is_on_parking_now');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
