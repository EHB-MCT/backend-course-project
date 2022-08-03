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
            case ($user->can('admin')):
                $users = User::all();
                break;
            case ($user->can('moderate')):
                $caretakers = User::role('caretaker')->get();
                $users->caretakers = fillCaretaker($caretakers);
                break;
            case ($user->can('caretaker')):
                $caretakers = User::where("id", $user->id)->get();
                $users->caretakers = fillCaretaker($caretakers);
                break;
            case ($user->can('client')):
                // A redirection
                break;
        }
//        dd($users);
        return $users;
    }

    public static function indexOnUserId ($id)
    {
        // Get the client with this id
        $client = User::firstWhere('id', $id);

        // TODO
        // With $client->... add needed data for showing stats

        // return the client
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
