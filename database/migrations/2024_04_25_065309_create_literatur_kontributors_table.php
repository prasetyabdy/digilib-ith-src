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
        Schema::create('literatur_kontributor', function (Blueprint $table) {
            $table->id();
            $table->string('user_id'); // Terhubung ke user role dosen 
            $table->unsignedBigInteger('literatur_id');
            $table->foreign('literatur_id')->references('id')->on('literatur')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('literatur_kontributors');
    }
};
