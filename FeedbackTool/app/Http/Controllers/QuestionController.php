<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        // Get all Questions
        return Question::all();
    }

    public static function indexOnSurveyId($id)
    {
        // Get the survey with this id
        $survey = Survey::firstWhere('id', $id);

        // Get the questions corresponding to this survey
        $survey->questions = $survey->question()->get();

        // return the survey
        return $survey ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'survey_id' => ['required', 'integer'],
            'question' => ['required', 'string', 'max:255'],
        ]);

        // Check if the survey the user tries to add a question to is his or hers and not edited in the hidden input field
        foreach (Auth::user()->survey()->get() as $survey){
            if($survey->id == $request->survey_id){
                Question::create([
                    'survey_id' => $request->survey_id,
                    'question' => $request->question,
                ]);
                return redirect()->route('survey', ['id' => $request->survey_id]);
            }
        }

        // return to dashboard if list is not of this user
        return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
