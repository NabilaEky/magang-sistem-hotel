<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeluhanCust extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_keluhan',
        'kategori',
        'deskripsi',
        'foto',
        'status'
    ];

    protected $casts = [
        'foto' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
