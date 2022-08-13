<?php

namespace App\Http\Controllers;

use App\Models\Session;
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
        $user = User::firstWhere('id', $id);

        // Get all filled sessions
        $user->sessions = Session::where('client_id', $user->id)->where('filled_status', 1)->get();

        // Get all survey lists only once
        $survlistArray = []; // Array with ids
        foreach ($user->sessions as $session){
            if (!in_array($session->survlist_id, $survlistArray)){
                array_push($survlistArray, $session->survlist_id); // Add id if it doesn't exist yet
            }
        }
        $user->survlists = Survlist::whereIn('id', $survlistArray)->get(); // Get full survey lists depending on the ids

//        dd($user);

        $user->tableOne = collect();
        $user->tableTwo = collect();

        $ten = [0, 1, 2.5, 3, 4.75, 5, 6, 7.1, 8, 9];

        // Fill table one
        foreach ($ten as $number){
            $user->tableOne->push($number);
            $user->tableTwo->push($number);
        }

        $user->tableOne->labels = $user->tableOne;
        $user->tableOne->data = $user->tableOne;

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

//$client->tableOne = collect();
//$client->tableTwo = collect();
//
//$ten = [0, 1, 2.5, 3, 4.75, 5, 6, 7.1, 8, 9];
//
//// Fill table one
//foreach ($ten as $number){
//    $client->tableOne->push($number);
//    $client->tableTwo->push($number);
//}

//        $client->sessions = Session::select('*')->where('client_id', $client->id)->where('filled_status', 1)->groupBy('survlist_id')->get();


//// Put the session survlists in the survlist collection
//$user->survlists = collect();
//foreach ($user->sessions as $session){
//    $user->survlists->push(Survlist::where('id', $session->survlist_id)->get());
//}
//// Limit all survlist to one of each
//$user->survlists = $user->survlists->groupBy('id');
//
//// For each survlist make a chart part
//for ($i = 0; $i < $user->survlists->count(); $i++){
//    $variable = 'chart'.$i;
//
//    $dates = Session::where('client_id', $user->id)->where('filled_status', 1)->get('created_at');
//    $user->$variable = $dates;
//}
////        foreach ($client->survlists as $survlist){
////            $
////            $survlist->dates = Session::where('client_id', $client->id)->where('filled_status', 1)->get('created_at');
////        }
