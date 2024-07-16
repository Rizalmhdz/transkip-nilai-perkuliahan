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
        Schema::create('karya_tuliss', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->unique();
            $table->string('nim')->unique();
            $table->string('pembimbing_1');
            $table->foreign('pembimbing_1')->references('nidn')->on('dosens'); 
            $table->string('pembimbing_2');
            $table->foreign('pembimbing_2')->references('nidn')->on('dosens'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karya_tuliss');
    }
};
