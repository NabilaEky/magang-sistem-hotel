<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    // Nama tabel (optional kalau nama plural sesuai konvensi Laravel)
    protected $table = 'audit_logs';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'user_id',
        'username',
        'name',
        'role',
        'action',
        'activity',
        'ip_address',
        'user_agent'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
