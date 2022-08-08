<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveySurvlist;
use App\Models\Survlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurvlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'list_name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
        ]);

        // Create a new survey
        $survlist = Survlist::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'list_name' => $request->list_name,
            'description' => $request->description,
        ]);

        // Get all surveys of the user
        if(Auth::user()->can('moderate')){
            $surveys = Survey::all();
        } else {
            $surveys = Auth::user()->survey()->get();
        }

        foreach ($surveys as $survey){
            $variable = 'survey' .$survey->id;

            if ($request->$variable === 'on'){
                echo $variable. " Works</br>";
                SurveySurvlist::create([
                    'survey_id' => $survey->id,
                    'survlist_id' => $survlist->id,
                ]);
            }
        }

        return redirect()->route('sessions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SessionUser  $sessionUser
     * @return \Illuminate\Http\Response
     */
    public function show(SessionUser $sessionUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SessionUser  $sessionUser
     * @return \Illuminate\Http\Response
     */
    public function edit(SessionUser $sessionUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SessionUser  $sessionUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SessionUser $sessionUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SessionUser  $sessionUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(SessionUser $sessionUser)
    {
        //
    }
}
