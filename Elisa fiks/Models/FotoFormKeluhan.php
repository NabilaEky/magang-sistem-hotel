<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoFormKeluhan extends Model
{
    protected $table = 'foto_form_keluhan';

    protected $fillable = [
        'form_keluhan_id',
        'foto'
    ];

    // relasi ke keluhan
    public function keluhan()
    {
        return $this->belongsTo(FormKeluhan::class, 'form_keluhan_id');
    }
}