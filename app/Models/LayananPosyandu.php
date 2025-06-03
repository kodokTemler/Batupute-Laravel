<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananPosyandu extends Model
{
    //
    protected $table = 'layanan_posyandu';
    protected $fillable = [
        'nama_pelayanan',
        'kategori',
        'tanggal_pelayanan',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'status',
    ];
}
