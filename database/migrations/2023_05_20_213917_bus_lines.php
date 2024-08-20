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
        Schema::create('bus_lines', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('bus_id');
            $table->foreign('busStop_id')->references('id')->on('bus_stops'); 
            $table->string('line_name');
            $table->string('company_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_lines');
    }
};
