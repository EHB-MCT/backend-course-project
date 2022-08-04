<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        // TODO
        // Give survey a boolean for it to be public or a private survey
        // Only get the public lists on the public page
        return Survey::all();
    }

    public static function privateSurveys()
    {
        $user = Auth::user();
        $surveys = collect();

        switch ($user) {

            // The surveys the moderator can see (all)
            case ($user->can('moderate')):
                $surveys = Survey::all();
                break;

            // The surveys the caretaker can see (own)
            case ($user->can('caretaker')):
                $surveys = Survey::where("user_id", $user->id)->get();
                break;
        }

        return $surveys;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function store(Request $request)
    {
        $user_id = Auth::user()->getAuthIdentifier();

        Survey::create([
            'user_id' => $user_id,
            'survey_name' => $request->survey_name,
        ]);

        return redirect()->route('surveys');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
