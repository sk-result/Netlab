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
        Schema::create('materi_matkuls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('bab');
            $table->text('description');
            $table->string('file_pdf');
            $table->foreignId('category_id')->constrained('matkul_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_matkuls');
    }
};
