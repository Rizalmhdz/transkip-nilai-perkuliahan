<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenProdisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen_prodis', function (Blueprint $table) {
            $table->id();
            $table->string('nidn');
            $table->foreign('nidn')
                ->references('nidn')->on('dosens')
                // ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('prodi');
            $table->foreign('prodi')
                ->references('id')->on('prodis')
                // ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('dosen_prodis');
    }
}
