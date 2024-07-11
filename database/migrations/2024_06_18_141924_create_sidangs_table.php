<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tugasakhir');
            $table->foreign('id_tugasakhir')->references('id')->on('tugas_akhirs')->onDelete('cascade');
            $table->date('tanggal');
            $table->unsignedBigInteger('id_ruang');
            $table->foreign('id_ruang')->references('id')->on('ruangans');
            $table->string('sesi');
            $table->unsignedBigInteger('ketua_sidang');
            $table->foreign('ketua_sidang')->references('id')->on('dosens');
            $table->unsignedBigInteger('sekretaris_sidang');
            $table->foreign('sekretaris_sidang')->references('id')->on('dosens');
            $table->string('anggota')->nullable();
            $table->string('status_kelulusan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sidangs');
    }
}
