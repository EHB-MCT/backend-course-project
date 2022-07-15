<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public static function all()
    {
        // Get all surveys
        return Survey::all();
    }

    public static function detail($id)
    {
        // Get the survey with this id
        $survey = Survey::firstWhere('id', $id);

        // Get the questions corresponding to this survey
        $survey->questions = Question::where('survey_id', $survey->id)->get();

        // return the survey
        return $survey ;
    }
}
