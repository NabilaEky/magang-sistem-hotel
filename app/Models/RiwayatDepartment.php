<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatDepartment extends Model
{
    protected $table = 'riwayat_departments';

    protected $fillable = [
        'waktu',
        'lokasi',
        'jenis_masalah',
        'status',
        'petugas',
    ];
}
