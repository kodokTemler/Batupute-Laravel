<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananPemerintahan extends Model
{
    protected $table = 'layanan_pemerintahan';

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'status',
    ];
}
