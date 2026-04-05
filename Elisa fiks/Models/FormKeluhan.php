<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormKeluhan extends Model
{
    protected $table = 'form_keluhan';

    protected $fillable = [
        'lokasi',
        'jenis_keluhan',
        'kategori',
        'status'
    ];

    // relasi ke foto
    public function foto()
    {
        return $this->hasMany(FotoFormKeluhan::class, 'form_keluhan_id');
    }
}