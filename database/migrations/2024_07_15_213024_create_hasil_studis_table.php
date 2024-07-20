<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilStudisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_studis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mata_kuliah');
            $table->foreign('id_mata_kuliah')->references('id')->on('mata_kuliahs');
            $table->string('nim');
            $table->foreign('nim')->references('nim')->on('mahasiswas');
            $table->unsignedInteger('nilai'); // Nilai antara 0 dan 4
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
        Schema::dropIfExists('hasil_studis');
    }
}
