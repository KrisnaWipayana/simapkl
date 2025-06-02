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
        Schema::create('laporan_mingguans', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('mahasiswa_id')->nullable();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->string('judul_laporan');
            $table->text('deskripsi_laporan');
            $table->string('status_laporan')->nullable();
            $table->timestamps();
        });

        Schema::create('laporan_akhirs', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('mahasiswa_id')->nullable();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->string('judul_laporan');
            $table->text('deskripsi_laporan');
            $table->string('file_laporan')->nullable();
            $table->string('status_laporan')->nullable();
            $table->timestamps();
        });

        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('mahasiswa_id')->nullable();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->string('file_cv')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan-mingguans');
        Schema::dropIfExists('laporan-akhirs');
        Schema::dropIfExists('cvs');
    }
};
