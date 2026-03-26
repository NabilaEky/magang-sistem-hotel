<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'departement_id',
        'nama',
        'kode',
        'deskripsi',
        'status',
        'level',
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 'aktif');
        });
    }
}
