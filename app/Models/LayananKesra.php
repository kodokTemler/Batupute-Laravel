<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananKesra extends Model
{
    //
    protected $table = 'layanan_kesra';
    protected $fillable = [
        'nama_layanan',
        'jenis_bantuan',
        'tahun',
        'deskripsi',
        'status',
        'file_dokumen',
    ];
}
