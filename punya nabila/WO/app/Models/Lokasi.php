<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi'; // nama tabel di database

    // Mass assignable fields
    protected $fillable = [
        'nama',
        'deskripsi',
        'kode',
        'status',
    ];

    // Definisikan konstanta status
    const STATUS_AKTIF = 'aktif';
    const STATUS_NON_AKTIF = 'non_aktif';

    /**
     * Global scope untuk hanya ambil data aktif
     */
    protected static function booted()
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', self::STATUS_AKTIF);
        });
    }
}