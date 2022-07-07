<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public static function all()
    {
        $data = Survey::all();

        return $data;
    }
}
