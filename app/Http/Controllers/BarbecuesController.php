<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Barbecue;
use App\Models\User;
use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\Product;


class BarbecuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Barbecues/Index');
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
        $user = auth()->user();
        $barbecue = $user->barbecues()->create($request->all());

        return response()->json($barbecue);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = auth()->user();
        $friends = $user->friends()->get();
        $barbecue = Barbecue::findOrFail($id);
        $barbecue = Barbecue::with('basket')
        ->with('basket.basketProduct')
        ->with('basket.basketProduct.product')
        ->with('members')
        ->find($id);
       
        $members = $barbecue->members()->get();

        foreach ($members as $member) {
            $friends = $friends->reject(function ($friend) use ($member) {
                return $friend->id === $member->id;
            });
        }
        
        return Inertia::render('Barbecues/Show', [
            'barbecue' => $barbecue,
            'friends' => $friends,
        ]);
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

    /**
     * Send invitation to join barbecue.
     */
    public function sendInvitation(Request $request, string $id)
    {
        $barbecue = Barbecue::findOrFail($id);
        $user = User::findOrFail($request->friend_id);
        $barbecue->sendInvitation($user);

        return redirect()->route('barbecues.show', ['barbecue' => $id]);
    }
}
