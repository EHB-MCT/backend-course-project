<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'list_name',
        'description',
    ];

    public function survey_ids()
    {
        return $this->hasMany(SurveySurvlist::class, 'survlist_id');
    }
}
