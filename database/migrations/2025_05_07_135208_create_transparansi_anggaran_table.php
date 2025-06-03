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
        Schema::create('transparansi_anggaran', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->string('sumber_dana');
            $table->decimal('jumlah_anggaran', 15, 2);
            $table->string('jenis_penggunaan');
            $table->enum('kategori', ['Pendapatan', 'Pengeluaran']);
            $table->text('keterangan');
            $table->string('file_bukti')->nullable();
            $table->enum('status', ['Publish', 'Draft']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transparansi_anggaran');
    }
};
