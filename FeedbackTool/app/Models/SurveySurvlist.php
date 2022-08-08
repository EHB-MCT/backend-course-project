<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveySurvlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'survlist_id',
    ];
}
