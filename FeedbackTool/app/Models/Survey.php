<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'survey_name',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function Question() {
        return $this->hasMany(Question::class);
    }
}
