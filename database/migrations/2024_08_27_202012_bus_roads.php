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
        Schema::create('bus_roads', function (Blueprint $table) {
            $table->id();  
            $table->unsignedBigInteger('road_group');
            $table->foreign('road_group')->references('id')->on('bus_lines')->onDelete('cascade');
            $table->string('latitude',20, 7);
            $table->string('longitude',20, 7);
            $table->integer('order');
            $table->string('color');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_roads');
    }
};
