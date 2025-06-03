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
        Schema::create('dokumen_publik', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->string('kategori');
            $table->year('tahun');
            $table->string('file_dokumen');
            $table->enum('status', ['Publish', 'Draft']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_publik');
    }
};
