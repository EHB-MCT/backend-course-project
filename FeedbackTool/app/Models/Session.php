<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'caretaker_id',
        'client_id',
        'survey_combination_id',
        'open_status',
        'filled_status',
        'duration_time',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
