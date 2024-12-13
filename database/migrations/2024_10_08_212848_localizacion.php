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
        Schema::create('localizacions', function (Blueprint $table) {
            $table->id();
            $table->string('latitude',20, 7);
            $table->string('longitude',20, 7);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('line_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('line_id')->references('id')->on('bus_lines')->onDelete('cascade');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localizacions');
    }
};
