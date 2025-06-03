<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananPengaduan extends Model
{
    //
    protected $table = 'layanan_pengaduan';
    protected $fillable = [
        'nama',
        'nomor_hp',
        'kategori',
        'isi_pengaduan',
        'status',
        'foto_bukti'
    ];
}
