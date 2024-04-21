<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\User;

class TestController extends Controller
{
    public function index()
    {
        $user_joan = User::where('email', 'jpaneque@cendrassos.net')->first();
        $user_roman = User::where('email', 'rmysyura@cendrassos.net')->first();
        $user_emma = User::where('email', 'ecardosa@cendrassos.net')->first();
        $user_aniol = User::where('email', 'amoreno@cendrassos.net')->first();
        $user_marcos = User::where('email', 'mmunoz@cendrassos.net')->first();


        $user_joan->sendFriendRequest($user_aniol);
    }    
}
