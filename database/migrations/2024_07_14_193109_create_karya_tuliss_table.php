<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryaTulissTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karya_tuliss', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->unique();
            $table->string('nim');
            $table->foreign('nim')->references('nim')->on('mahasiswas');
            $table->string('pembimbing');
            $table->foreign('pembimbing')->references('nidn')->on('dosens');
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
        Schema::dropIfExists('karya_tuliss');
    }
}
