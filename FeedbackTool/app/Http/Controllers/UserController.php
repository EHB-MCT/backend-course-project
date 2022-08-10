<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $client = User::firstWhere('id', $id);

        $client->tableOne = collect();
        $client->tableTwo = collect();

        $ten = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

        // Fill table one
        foreach ($ten as $number){
            $client->tableOne->push($number);
            $client->tableTwo->push($number);
        }

        return $client;
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
