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
        Schema::create('transparansi_bumdes', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->year('tahun');
            $table->string('file_bukti');
            $table->enum('status', ['Draft', 'Publish']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transparansi_bumdes');
    }
};
