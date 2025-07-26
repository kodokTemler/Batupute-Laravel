<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenKhusus extends Model
{
    //
    protected $table = 'dokumen_khusus';
    protected $fillable = [
        'nama_dokumen',
        'file',
    ];
}
