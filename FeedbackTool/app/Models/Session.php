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
        'survlist_id',
        'open_status',
        'filled_status',
        'duration_time',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function survlist()
    {
        return $this->hasOne(Survlist::class, 'id', 'survlist_id');
    }
}
