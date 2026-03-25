<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Feedback;

class KeluhanAdmin extends Model
{
    protected $fillable = [
        'id',
        'waktu',
        'lokasi',
        'jenis_masalah',
        'prioritas',
        'status',
        'petugas'
    ];

    public function petugas()
    {
        return $this->belongsTo(PetugasAdmin::class, 'petugas_admin_id');
    }

    public function fotoMasalah()
    {
        return $this->hasOne(FotoMasalah::class, 'keluhan_id');
    }

    public function pengerjaan()
    {
        return $this->hasOne(PengerjaanPetugas::class, 'keluhan_id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'keluhan_id');
    }
}
