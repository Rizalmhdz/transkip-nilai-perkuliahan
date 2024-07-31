<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 10)->unique();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('angkatan');
            $table->unsignedBigInteger('prodi');
            $table->foreign('prodi')
                ->references('id')->on('prodis')
                // ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('dosen_akademik');
            $table->foreign('dosen_akademik')
                ->references('nidn')->on('dosens')
                // ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->year('tahun_lulus')->nullable();
            $table->date('tanggal_yudisium')->nullable();
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
        Schema::dropIfExists('mahasiswas');
    }
}
