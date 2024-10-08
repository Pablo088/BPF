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
            $table->string('line_name');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('bus_companies')->onDelete('cascade');
            $table->time('horario_comienzo');
            $table->time("horario_finalizacion");
            $table->string('color');
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