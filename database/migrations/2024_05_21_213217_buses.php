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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();        
            $table->integer('number');
            $table->dateTime('departure_time');
            $table->unsignedBigInteger('line_id');
            $table->unsignedBigInteger('stop_id');
            $table->enum('status', ['operating', 'not operating'])->default('operating');
            $table->timestamps();

            $table->foreign('line_id')->references('id')->on('bus_lines');
            $table->foreign('stop_id')->references('id')->on('bus_stops'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};