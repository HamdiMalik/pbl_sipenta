<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tugasakhir');
            $table->foreign('id_tugasakhir')->references('id')->on('tugas_akhirs')->onDelete('cascade');
            $table->unsignedBigInteger('dosen_penguji');
            $table->foreign('dosen_penguji')->references('id')->on('dosens');
            $table->integer('nilai');
            $table->string('kategori')->nullable();
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
