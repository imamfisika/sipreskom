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
     *bobot
     *semester
     *nilai

     */
    public function up(): void {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_matkul');
            $table->foreign('id_matkul')->references('id')->on('matkuls')->onDelete('cascade');
            $table->float('bobot');
            $table->integer('semester');
            $table->string('nilai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('nilais');
    }
};
