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
        Schema::create('dospems', function (Blueprint $table) {
        $table->id();
        // $table->foreignId('mahasiswa_id')->nullable()->constrained('mahasiswas')->onDelete('cascade');
        $table->string('nip')->unique();
        $table->string('nama');
        $table->string('password');
        $table->string('foto')->nullable();
        $table->timestamps();
        $table->rememberToken();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dospems');
    }
};


