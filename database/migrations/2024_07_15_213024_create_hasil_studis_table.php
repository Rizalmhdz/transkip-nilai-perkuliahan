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
        Schema::create('hasil_studis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mata_kuliah');
            $table->foreign('kode_mata_kuliah')->references('kode_mata_kuliah')->on('mata_kuliahs'); 
            $table->unsignedBigInteger('id_rencana_studi');
            $table->foreign('id_rencana_studi')->references('id')->on('rencana_studis'); 
            $table->unsignedBigInteger('nilai');
            $table->enum('status', ['lulus', 'tidak lulus']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_studis');
    }
};
