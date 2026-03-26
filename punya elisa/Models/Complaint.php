<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'user_id',
        'lokasi',
        'jenis_masalah',
        'deskripsi',
        'prioritas',
        'status',
        'catatan',
        'foto'
    ];

    protected $casts = [
    'bukti_foto' => 'array',
    'foto_selesai' => 'array',
];
}
