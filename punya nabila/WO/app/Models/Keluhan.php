<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    protected $fillable = [
        'user_id', 
        'jenis_masalah',
        'kategori',
        'lokasi',
        'deskripsi',
        'petugas_id',
        'status',
        'prioritas',
        'catatan_admin',
        'catatan_petugas',
        'rating',
        'komentar',
        'waktu_selesai',
        'foto1',
        'foto2',
        'foto3',
    ];

    // 🔥 Relasi ke petugas (User)
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
