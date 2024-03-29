<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Session;
use App\Models\Survey;
use App\Models\Survlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        $user = Auth::user();
        $users = collect();

        switch ($user){

            // The users the admin can see
            case ($user->can('admin')):
                $users->admins = User::role('admin')->get();
                $users->moderators = User::role('moderator')->get();
                $users->caretakers = fillCaretaker(User::role('caretaker')->get());
                break;

            // The users the moderator can see
            case ($user->can('moderate')):
                $users->caretakers = fillCaretaker(User::role('caretaker')->get());
                break;

            // The users the caretaker can see
            case ($user->can('caretaker')):
                $users->caretakers = fillCaretaker(User::where("id", $user->id)->get());
                break;

            // Redirect client to his own page
            case ($user->can('client')):
                // A redirection
                break;
        }

        return $users;
    }

    public static function indexOnUserId ($id)
    {
        // Get the client with this id
        if (User::firstWhere('id', $id)->where('caretaker_id', Auth::user()->getAuthIdentifier())->exists() || Auth::user()->can('admin') && !Auth::user()->hasRole('moderator')){

            // Get client
            $userFetch = User::where('id', $id)->get();
            $user = $userFetch[0];
            
            // Get all filled sessions
            $user->sessions = Session::where('client_id', $user->id)->where('filled_status', 1)->get();

            // Get all survey lists only once
            $survlistArray = []; // Array with ids for get the survey list models later
            foreach ($user->sessions as $session){
                if (!in_array($session->survlist_id, $survlistArray)){
                    array_push($survlistArray, $session->survlist_id); // Add id if it doesn't exist yet
                }
            }
            $user->survlists = Survlist::whereIn('id', $survlistArray)->get(); // Get full survey lists depending on the ids

            // Fill survey lists with surveys and questions
            foreach ($user->survlists as $survlist){
                
                // Get the surveys
                $surveys = collect();
                foreach ($survlist->survey_ids()->get('survey_id') as $id) {
                    $surveys->push(Survey::firstWhere('id', $id->survey_id));
                }

                // Get the survey questions
                $questions = collect();
                foreach ($surveys as $survey) {
                    $surveyQuestions = $survey->question()->get();
                    foreach ($surveyQuestions as $question) {
                        $questions->push($question);
                    }
                }

                // Data storage
                $dates = collect();
                $questionNames = collect();
                $scores = collect();

                // only get fully filled in sessions
                foreach (Session::where('client_id', $user->id)->where('survlist_id', $survlist->id)->where('filled_status', 1)->get() as $session) {
                    $dates->push($session->created_at->toString());
                }

                // Loop over questions
                foreach ($questions as $question) {

                    // Fill question results
                    $results = [];

                    // only get fully filled in sessions
                    foreach (Session::where('client_id', $user->id)->where('survlist_id', $survlist->id)->where('filled_status', 1)->get() as $session) {

                        // Get question response from certain sessions
                        if(Response::where('question_id', $question->id)->where('session_id', $session->id)->exists()) {
                            $response = Response::where('question_id', $question->id)->where('session_id', $session->id)->get('score');
                            array_push($results, $response[0]->score);
                        }
                    }

                    $questionNames->push($question->question);
                    $scores->push($results);

                }

                $survlist->dates = $dates;
                $survlist->questions = $questionNames;
                $survlist->scores = $scores;
            }
            return $user;
        } else {
            return null;
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

function fillCaretaker($caretakers){
    foreach ($caretakers as $caretaker){
        $caretaker->clients = User::where("caretaker_id", $caretaker->id)->get();
    }
    return $caretakers;
}
