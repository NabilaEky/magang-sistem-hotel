<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'foto',
        'nama',
        'email',
        'no_hp',
        'username',
        'password'
    ];
}