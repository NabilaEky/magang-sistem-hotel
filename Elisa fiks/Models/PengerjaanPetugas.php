<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengerjaanPetugas extends Model
{
    protected $table = 'pengerjaan_petugas';

    protected $fillable = [
        'keluhan_id',
        'foto1','foto2','foto3','foto4','foto5','foto6',
        'catatan'
    ];

    public function keluhan()
    {
        return $this->belongsTo(KeluhanAdmin::class, 'keluhan_id');
    }
}
