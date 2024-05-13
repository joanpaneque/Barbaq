<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

use App\Models\User;


class GoogleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Socialite::driver('google')->redirect();
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
    public function store(Request $request)
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            $user = User::create([
                'id' => $googleUser->id,
                'name' => $googleUser->user['given_name'],
                'surnames' => $googleUser->user['family_name'],
                'email' => $googleUser->email,
                'password' => Str::random(16),
                'google_access_token' => $googleUser->token,
            ]);
        } else {
            $user->google_access_token = $googleUser->token;
            $user->save();
        }

        Auth::login($user);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
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
        //
    }

    // public function addEventToCalendar(Request $request) {

    //     // $barbecueDate = $request->input('date');

    //     $client = new Google_Client();
    //     $client->setClientId(env('GOOGLE_CLIENT_ID'));
    //     $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    //     $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
    //     $client->setScopes([
    //         Google_Service_Calendar::CALENDAR,
    //         'https://www.googleapis.com/auth/calendar.events'
    //     ]);

    //     $accessToken = Auth::user()->google_access_token;
    //     $client->setAccessToken($accessToken);

    //     // if ($client->isAccessTokenExpired()) {
    //     //     $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    //     //     $request->session()->put('google_access_token', $client->getAccessToken());
    //     // }

    //     $service = new Google_Service_Calendar($client);

    //     $event = new Google_Service_Calendar_Event([
    //         'summary' => 'Barbecue',
    //         'location' => '123 Main St, City, Country',
    //         'description' => 'Barbecue with friends',
    //         'start' => [
    //             'dateTime' => '2024-05-15T18:00:00',
    //             'timeZone' => 'Europe/Madrid',
    //         ],
    //     ]);

    //     $calendarId = 'primary';
        
    //     $event = $service->events->insert($calendarId, $event);

    //     return redirect('/');
    // }
}
