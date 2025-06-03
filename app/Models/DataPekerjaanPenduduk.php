<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPekerjaanPenduduk extends Model
{
    //
    protected $table = 'data_pekerjaan_penduduk';
    protected $fillable = [
        'pekerjaan',
        'jumlah',
    ];
}
