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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kategori');
            $table->integer('jumlah');
            $table->enum('kondisi', ['Baik', 'Rusak'])->default('Baik');
            $table->year('tahun_pengadaan');
            $table->string('sumber_dana');
            $table->decimal('harga_per_barang');
            $table->string('lokasi_penyimpanan');
            $table->string('foto_barang')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
