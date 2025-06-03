<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKegiatan extends Model
{
    protected $table = 'laporan_kegiatan';
    protected $fillable = [
        'nama_kegiatan',
        'tanggal_kegiatan',
        'lokasi',
        'anggaran',
        'deskripsi',
        'file_laporan',
        'foto_kegiatan',
        'status',
    ];
}
