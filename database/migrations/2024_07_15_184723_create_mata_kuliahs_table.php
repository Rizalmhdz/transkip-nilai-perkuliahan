<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataKuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mata_kuliah');
            $table->unsignedInteger('sks');
            $table->string('kategori_matkul');
            $table->foreign('kategori_matkul')->references('kode_kategori')->on('kategori_matkuls');
            $table->string('dosen_pengampu');
            $table->foreign('dosen_pengampu')->references('nidn')->on('dosens');
            $table->unsignedBigInteger('prodi');
            $table->foreign('prodi')->references('id')->on('prodis');
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
        Schema::dropIfExists('mata_kuliahs');
    }
}
