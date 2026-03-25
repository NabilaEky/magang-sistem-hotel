<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoMasalah extends Model
{
    protected $table = 'foto_masalah';

    protected $fillable = [
        'keluhan_id',
        'foto1','foto2','foto3'
    ];

    public function keluhan()
    {
        return $this->belongsTo(KeluhanAdmin::class, 'keluhan_id');
    }
}
