<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Friendship;
use App\Models\User;
use App\Models\Notification;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $friends = $user->friends()->get();

        return Inertia::render('Friends/Index', [
            'friends' => $friends,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $id)
    {
        $sender = auth()->user();
        $receiver = User::findOrFail($id);
        $sender->sendFriendRequest($receiver);
        $receiver->sendNotification($receiver->id);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // GET THE AUTHENTICATED USER
        $user = auth()->user();

    }

    /**
     * Showaws the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        $friend = User::findOrFail($id);
        $user->removeFriend($friend);
    }
}