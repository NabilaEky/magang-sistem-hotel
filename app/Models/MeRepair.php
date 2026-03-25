<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeRepair extends Model
{
    protected $table = 'me_repairs';

    protected $fillable = [
        'tgl',
        'lokasi',
        'pekerjaan',
        'gambar_temuan',
        'gambar_progress',
        'selesai',
        'keterangan',
        'petugas'
    ];
}
