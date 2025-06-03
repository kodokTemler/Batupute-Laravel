<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransparansiAnggaran extends Model
{
    protected $table = 'transparansi_anggaran';
    protected $fillable = [
        'tahun',
        'sumber_dana',
        'jumlah_anggaran',
        'jenis_penggunaan',
        'kategori',
        'keterangan',
        'file_bukti',
        'status',
    ];

    protected $guarded = [];
}
