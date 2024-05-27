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
        Schema::create('bus_stops', function (Blueprint $table) {
            $table->id();
            $table->string('direction')->nullable();
            //$table->unsignedBigInteger('bus_id');
            $table->string('latitude',10, 7);
            $table->string('longitude',10, 7);
            $table->timestamps();

            //$table->foreign('bus_id')->references('id')->on('buses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_stops');
    }
};
