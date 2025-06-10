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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('foto')->nullable();
            $table->foreignId('prodi_id')->constrained('prodis')->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
            $table->unsignedBigInteger('perusahaan_id')->constrained('perusahaans')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('lowongan_id')->constrained('lowongans')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
