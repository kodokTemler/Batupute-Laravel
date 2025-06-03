<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenPublik extends Model
{
    //
    protected $table = 'dokumen_publik';
    protected $fillable = [
        'nama_dokumen',
        'kategori',
        'tahun',
        'file_dokumen',
        'status',
    ];
}
