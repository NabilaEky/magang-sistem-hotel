<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = [
        'keluhan_id',
        'rating',
        'komentar'
    ];

    public function keluhan()
    {
        return $this->belongsTo(KeluhanAdmin::class, 'keluhan_id');
    }
}