<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * id
     *id_mahasiswa
     *id_matkul
     *nama_dosen
     *keterangan

     */
    public function up(): void {
        Schema::create('rekomendasis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_matkul');
            $table->foreign('id_matkul')->references('id')->on('matkuls')->onDelete('cascade');
            $table->string('nama_dosen');
            $table->text('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('rekomendasis');
    }
};
