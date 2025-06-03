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
        Schema::create('layanan_kesra', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan');
            $table->string('jenis_bantuan');
            $table->year('tahun');
            $table->string('deskripsi')->nullable();
            $table->enum('status', ['Draft', 'Publish']);
            $table->string('file_dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_kesra');
    }
};
