<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Models\UserBarbecues;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{

    public function show(string $id)
    {   
        $user = auth()->user();
        $friends = $user->friends()->get();

        $profile = User::with(['barbecues' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->where('id', $id)->first();
        
        $friendStatus = "none";

        if ($user->isFriendWith($profile)) {
            $friendStatus = 'friend';
        } else if ($user->alreadySentFriendRequestTo($profile)) {
            $friendStatus = 'sent';
        } else if ($user->alreadyHasFriendRequestFrom($profile)) {
            $friendStatus = 'received';
        } 

        $users = User::whereNotIn('id', $friends->pluck('id'))
        ->where('id', '!=', $user->id)
        ->inRandomOrder()
        ->get();

        for ($i = 0; $i < count($users); $i++) {
            $friendStatus1 = "none";
            if ($user->isFriendWith($users[$i])) {
                $friendStatus1 = 'friend';
            } else if ($user->alreadySentFriendRequestTo($users[$i])) {
                $friendStatus1 = 'sent';
            } else if ($user->alreadyHasFriendRequestFrom($users[$i])) {
                $friendStatus1 = 'received';
            } 
            $users[$i]->friendStatus1 = $friendStatus1;
        }

        // get only the users that the friend status is none
        $filteredUsers = [];
        foreach ($users as $user) {
            if ($user->friendStatus1 === 'none') {
                $filteredUsers[] = $user;
            }
        }

        return Inertia::render('UserProfile/Index', [
            'user' => $profile,
            'friendStatus' => $friendStatus,
            'friends' => $friends,
            'filteredUsers' => $filteredUsers,
        ]);

    }	
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, string $id)
    {

        $request->all();
        $user = $request->user();
        $user->update($request->only('name', 'email', 'surnames', 'vegetarian', 'lactose', 'gluten', 'spicy', 'halal')); 

        return redirect()->route('profile.show', ['profile' => $id]);
    }


   

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
