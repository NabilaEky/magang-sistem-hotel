<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Departement extends Model
{
    protected $fillable = [
        'nama',
        'kode',
        'deskripsi',
        'status',
    ];

    public function jabatans()
    {
        return $this->hasMany(Jabatan::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 'aktif');
        });
    }
}
