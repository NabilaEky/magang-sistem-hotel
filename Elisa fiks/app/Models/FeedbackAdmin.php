<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackAdmin extends Model
{
    protected $table = 'feedback_admin';

    protected $fillable = [
        'kode_feedback',
        'lokasi',
        'petugas',
        'rating',
        'komentar',
        'tanggal'
    ];

    public function keluhan()
    {
        return $this->belongsTo(KeluhanAdmin::class, 'keluhan_id');
    }
}
