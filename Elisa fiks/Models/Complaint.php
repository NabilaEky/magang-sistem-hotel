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
        'foto',
        'bukti_foto',
        'foto_selesai'
    ];

    protected $casts = [
        'foto' => 'array',
        'bukti_foto' => 'array',
        'foto_selesai' => 'array',
    ];

    public function admin()
    {
        return $this->hasOne(KeluhanAdmin::class);
    }
}
