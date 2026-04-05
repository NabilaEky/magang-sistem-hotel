<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKeluhan extends Model
{
    protected $fillable = [
        'waktu',
        'jenis_masalah',
        'lokasi',
        'petugas',
        'tanggal_selesai'
    ];
}