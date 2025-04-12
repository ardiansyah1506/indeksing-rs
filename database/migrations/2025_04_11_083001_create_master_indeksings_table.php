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
        Schema::create('master_indeksing', function (Blueprint $table) {
            $table->id();
            $table->integer('no_rm')->nullable();
            $table->string('nama_pasien');
            $table->enum('jk', [1, 0])->nullable();
            $table->date('usia');
            $table->string('alamat');
            $table->date('tgl_kunjungan');
            $table->integer('icd10primary')->nullable();
            $table->integer('icd10secondary')->nullable();
            $table->integer('icd9')->nullable();
            $table->integer('id_dokter');
            $table->integer('id_poli');
            $table->enum('jenis_kunjungan', [1, 2])->nullable();
            $table->enum('cara_keluar', [1, 2])->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_indeksings');
    }
};
