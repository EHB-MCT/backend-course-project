<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public static function all()
    {
        return Survey::all();
    }

    public static function detail($id)
    {
        $survey = Survey::firstWhere('id', $id);
        
        return $survey ;
    }
}
