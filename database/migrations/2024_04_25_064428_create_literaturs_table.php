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
        Schema::create('literatur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->text('penulis_kontributor')->nullable(); //Khusus jurnal
            $table->string('judul');
            $table->text('abstrak');
            $table->text('keyword')->nullable();
            $table->string('penerbit')->nullable();
            $table->unsignedBigInteger('jenis_id')->nullable();
            $table->foreign('jenis_id')->references('id')->on('jenis')->cascadeOnDelete();
            $table->integer('view')->default(0);
            $table->text('doi')->nullable();
            $table->enum('status', ['proses', 'diterima', 'ditolak'])->default('proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('literaturs');
    }
};
