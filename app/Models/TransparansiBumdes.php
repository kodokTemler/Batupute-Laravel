<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransparansiBumdes extends Model
{
    protected $table = 'transparansi_bumdes';

    protected $fillable = [
        'judul',
        'tahun',
        'file_bukti',
        'status',
    ];
}
