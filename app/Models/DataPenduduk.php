<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPenduduk extends Model
{
    protected $table = 'data_penduduk';
    protected $fillable = [
        'kategori',
        'jumlah'
    ];
}
