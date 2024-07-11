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
        Schema::create('tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('pembimbing1');
            $table->unsignedBigInteger('pembimbing2');
            $table->string('dokumen_laporan_pkl')->nullable();
            $table->string('dokumen_lembar_pembimbing')->nullable();
            $table->string('dokumen_proposal_tugas_akhir')->nullable();
            $table->string('dokumen_laporan_tugas_akhir')->nullable();
            $table->boolean('validasi_pembimbing')->default(false);
            $table->boolean('validasi_penguji')->default(false);
            $table->string('status')->default('menunggu');
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas');
            $table->foreign('pembimbing1')->references('id')->on('dosens');
            $table->foreign('pembimbing2')->references('id')->on('dosens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_akhirs');
    }
};
