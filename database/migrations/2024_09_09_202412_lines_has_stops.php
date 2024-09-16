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
        Schema::create('line_has_stops', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('busLine_id');
            $table->unsignedBigInteger('busStop_id');
            $table->foreign('busLine_id')->references('id')->on('bus_lines')->onDelete('cascade');
            $table->foreign('busStop_id')->references('id')->on('bus_stops')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_has_stops');
    }
};
