<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    //
    protected $table = 'karyawan'; // Nama tabel

    protected $fillable = [
        'nama',
        'jabatan',
        'jenis_kelamin',
        'agama',
        'tanggal_lahir',
        'alamat',
        'nomor_hp',
        'email',
        'foto',
        'pendidikan_terakhir',
    ];
}
