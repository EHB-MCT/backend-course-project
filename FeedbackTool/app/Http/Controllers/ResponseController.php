<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Response;
use App\Models\Session;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        $user = Auth::user();
        if ($user->can('moderate')){
            $user->sessions = Session::where('open_status', 0);
        } else {
            $user->sessions = $user->session()->where('open_status', 0)->get();
        }

        foreach ($user->sessions as $session) {
            $session->survlist = $session->survlist()->get();
        }

        return $user->sessions;
    }

    public static function sessionOnId($id)
    {
        $user = Auth::user();

        if($user->hasRole('caretaker') || $user->hasRole('client')){
            // Check if session exists and isn't filled in or closed
            if ($user->session()->where('open_status', 0)->where('filled_status', 0)->where('id', $id)->exists()) {

                // Get the chosen session
                $user->session = $user->session()->where('open_status', 0)->where('filled_status', 0)->where('id', $id)->get();

                // Get the survey list
                $user->survlist = $user->session[0]->survlist()->get();

                // Get the surveys
                $user->surveys = collect();
                foreach ($user->survlist[0]->survey_ids()->get('survey_id') as $id) {
                    $user->surveys->push(Survey::firstWhere('id', $id->survey_id));
                }

                // Get the survey questions
                foreach ($user->surveys as $survey) {
                    $surveyQuestions = $survey->question()->get();
                    foreach ($surveyQuestions as $question) {

                        // If question is not filled in, return it as current question
                        if (!Response::where('question_id', $question->id)->where('session_id', $user->session[0]->id)->exists()) {
                            return $question;
                        }
                    }
                }
            } else {
                return null;
            }
        }
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
            'question_id' => ['required', 'integer'],
            'session_id' => ['required', 'integer'],
            'score' => ['required', 'integer'],
        ]);

        $user = Auth::user();

        // Check if session exists and isn't filled in or closed
        if ($user->session()->where('open_status', 0)->where('filled_status', 0)->where('id', $request->session_id)->exists()) {

            // Get the chosen session
            $user->session = $user->session()->where('open_status', 0)->where('filled_status', 0)->where('id', $request->session_id)->get();

            // Get the survey list
            $user->survlist = $user->session[0]->survlist()->get();

            // Get the surveys
            $user->surveys = collect();
            foreach ($user->survlist[0]->survey_ids()->get('survey_id') as $id) {
                $user->surveys->push(Survey::firstWhere('id', $id->survey_id));
            }

            // Get the survey questions
            $user->questions = collect();
            foreach ($user->surveys as $survey) {
                $surveyQuestions = $survey->question()->get();
                foreach ($surveyQuestions as $question) {
                    $user->questions->push($question);
                }
            }
        }

        $givenQuestion = Question::where('id', $request->question_id)->get();

        foreach ($user->questions as $question){
            if ($question == $givenQuestion[0] &&
                !Response::where('question_id', $question->id)->where('session_id', $user->session[0]->id)->exists()) {

                // Create a new response
                Response::create([
                    'question_id' => $request->question_id,
                    'session_id' => $request->session_id,
                    'score' => $request->score,
                ]);

                if ($question === $user->questions->last()){
                    $user->session[0]->update([
                        'open_status' => 1,
                        'filled_status' => 1,
                    ]);
                    return redirect()->route('welcome');
                }
            }
        }

        return redirect()->route('session', ['id' => $request->session_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }
}
