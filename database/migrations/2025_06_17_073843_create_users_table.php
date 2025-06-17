<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * nama
 * nim
* email
* foto
* role
* id_dosen nullable

     */
    
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama');
            $table->string('nim')->unique();
            $table->string('email')->unique();
            $table->string('foto')->nullable();
            $table->enum('role', ['mahasiswa', 'dosen'])->default('mahasiswa');
            $table->unsignedBigInteger('id_dosen_pas')->nullable();
            $table->foreign('id_dosen_pas')->references('id')->on('dosen_pas')->onDelete('set null');
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
