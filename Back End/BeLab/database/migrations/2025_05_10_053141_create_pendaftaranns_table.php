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
         Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nim')->unique();
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('alamat');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 15);
            $table->string('image')->nullable(); // untuk menyimpan path gambar
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::dropIfExists('pendaftarans');
    }
};
