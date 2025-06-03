<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    //
    protected $table = 'inventaris';
    protected $fillable = [
        'nama_barang',
        'kategori',
        'jumlah',
        'kondisi',
        'tahun_pengadaan',
        'sumber_dana',
        'harga_per_barang',
        'lokasi_penyimpanan',
        'foto_barang',
        'keterangan'
    ];
}
