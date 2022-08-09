<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Survey;
use App\Models\Survlist;
use App\Models\User;
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
        if ($user->can('moderate')){
            $user->surveys = Survey::all();
            $user->survlists = Survlist::all();
            $user->sessions = Session::all();
        } else {
            $user->surveys = $user->survey()->get();
            $user->survlists = $user->survlists()->get();
            $user->sessions = $user->session()->get();
            $user->clients = User::where("caretaker_id", Auth::user()->getAuthIdentifier())->get();
        }

        foreach ($user->surveys as $survey){
            $survey->questions = $survey->question()->get();
        }

        foreach ($user->survlists as $survlist) {
            $survlist->surveys = collect();
            foreach ($survlist->survey_ids()->get('survey_id') as $id) {
                $survey = Survey::firstWhere('id', $id->survey_id);
                $survlist->surveys->push($survey);
            }
        }

        foreach ($user->sessions as $session) {
            $session->client = User::where('id', $session->client_id)->get();
            $session->survlist = $session->survlist()->get();
            $session->surveys = collect();

            foreach ($session->survlist as $list) {
                foreach ($list->survey_ids()->get('survey_id') as $id){
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
        // Validate request
        $request->validate([
            'client' => ['required', 'integer'],
            'survlist' => ['required', 'integer'],
        ]);

        // Create a new survey
        Session::create([
            'caretaker_id' => Auth::user()->getAuthIdentifier(),
            'client_id' => $request->client,
            'survlist_id' => $request->survlist,
        ]);

        return redirect()->route('sessions');
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
