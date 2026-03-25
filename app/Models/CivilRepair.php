<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CivilRepair extends Model
{
    protected $table = 'civil_repairs';

    protected $fillable = [
        'tgl',
        'lokasi',
        'pekerjaan',
        'gambar_temuan',
        'gambar_progress',
        'gambar_selesai',
        'keterangan',
        'petugas'
    ];
}