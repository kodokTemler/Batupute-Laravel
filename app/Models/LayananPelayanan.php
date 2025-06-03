<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananPelayanan extends Model
{
    //
    protected $table = 'layanan_pelayanan';
    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'status',
    ];
}
