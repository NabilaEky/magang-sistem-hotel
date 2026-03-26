<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['kode','nama','deskripsi','status'];

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