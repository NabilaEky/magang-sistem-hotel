<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeptProfile extends Model
{
    protected $fillable = [
        'nama',
        'role',
        'email',
        'no_hp',
        'username',
        'password',
        'notifikasi',
        'last_login'
    ];

    protected $casts = [
        'notifikasi' => 'boolean',
        'last_login' => 'datetime'
    ];
}
