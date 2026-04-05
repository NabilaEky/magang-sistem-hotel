<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // 

class LaporanEng extends Model
{
    protected $table = 'laporan_engs'; 

    protected $fillable = [
        'user_id',     
        'realisasi',
        'jenis',
        'shift',
        'status',
        'items',
        'jam_mulai',
        'jam_selesai',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    // ✅ RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}