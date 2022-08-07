<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Survey;
use App\Models\Survlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        $user = Auth::user();
        if (Auth::user()->can('moderate')){
            $user->sessions = Session::all();
        } else {
            $user->sessions = $user->session()->get();
        }

        foreach ($user->sessions as $session) {
            $session->survlist = $session->survlist()->get();
            $session->surveys = collect();

            foreach ($session->survlist as $list) {
                $survey_ids = $list->survey_ids()->get('survey_id');
                foreach ($survey_ids as $id){
                    $survey = Survey::firstWhere('id', $id->survey_id);
                    $survey->questions = $survey->question()->get();
                    $session->surveys->push($survey);
                }
            }
        }

//        dd($user);
        return $user;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }
}
