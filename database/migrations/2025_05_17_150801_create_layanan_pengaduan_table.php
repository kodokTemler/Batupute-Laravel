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
        Schema::create('layanan_pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor_hp', 15); // Maksimal 15 digit, unik
            $table->string('kategori');
            $table->text('isi_pengaduan');
            $table->enum('status', ['Diterima', 'Diproses', 'Selesai'])->default('Diterima');
            $table->string('foto_bukti')->nullable(); // Untuk menyimpan bukti pengaduan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_pengaduan');
    }
};
