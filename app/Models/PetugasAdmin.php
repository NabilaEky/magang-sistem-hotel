<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetugasAdmin extends Model
{
    protected $fillable = [
        'nama',
        'shift',
        'petugas_aktif',
        'status'
    ];
}
