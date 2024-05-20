<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function apiShowLogged()
    {
        //;check if logged
        if (!auth()->check()) {
            return response()->json([]);
        }


        $user = User::with('friends', 'barbecuesFriendships', 'products')->where('id', auth()->id())->first();
        
        $user['notifications'] = $user->notifications();
        
            return response()->json($user);
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

        
        $user = User::findOrFail($id);

        $image = $request->file('image');
    
        if ($image) {
            $path = $image->move('assets/img');
            
            $filename = basename($path);
            $url = '/assets/img/' . $filename;
            $user->image = $url;
        }

        $user->save();

        //reload the page
        
        
    }


    public function updateDescription(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->description = $request->description;
        $user->save();

        return redirect()->back();
    }

    public function togglePrivate()
    {
        $user = User::find(auth()->id());
        $user->public = !$user->public;
        $user->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
