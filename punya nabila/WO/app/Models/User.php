<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, HasRoles;

    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'email',
        'username',
        'jabatan',
        'password',
        'id_pengguna',
        'notification_enabled',
        'notification_volume',
        'phone',
        'last_login_at',
        'profile_photo_path'
    ];

    protected $casts = [
        'notification_enabled' => 'boolean',
        'notification_volume' => 'integer',
        'last_login_at' => 'datetime'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    // Relasi keluhan yang dibuat user (pelapor)
    public function keluhanDibuat()
    {
        return $this->hasMany(Keluhan::class, 'user_id');
    }

    public function keluhanDitangani()
    {
        return $this->hasMany(Keluhan::class, 'petugas_id');
    }
}
