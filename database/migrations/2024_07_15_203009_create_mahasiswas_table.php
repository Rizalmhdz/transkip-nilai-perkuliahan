<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->integer('angkatan');
            // $table->integer('semester');

            // Foreign key custom column
            $table->string('email_mhs');
            $table->foreign('email_mhs')->references('email')->on('users'); // References 'id' column on 'users' table
            $table->string('dosen_akademik');
            $table->foreign('dosen_akademik')->references('nip')->on('dosens'); // References 'id' column on 'users' table

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
