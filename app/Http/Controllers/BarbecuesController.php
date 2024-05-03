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

    public function apiIndex(Request $request)
    {
        $limit = $request->input('limit');
        $offset = $request->input('offset');

        $order = $request->input('order', 'desc');
        $time = $request->input('time', 'forever');
        $search = $request->input('search');

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $distance = $request->input('distance');

        // get the barbecue with user and images
        $barbecues = Barbecue::with('user', 'images', 'comments');

        if ($limit) {
            $barbecues = $barbecues->limit($limit);
        }

        if ($offset) {
            $barbecues = $barbecues->offset($offset);
        }

        if ($order === 'asc') {
            $barbecues = $barbecues->orderBy('created_at', 'asc');
        } else {
            $barbecues = $barbecues->orderBy('created_at', 'desc');
        }

        if ($latitude && $longitude) {
            $barbecues = $barbecues->selectRaw('*, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance', [$latitude, $longitude, $latitude]);

            if ($distance) {
                $barbecues = $barbecues->having('distance', '<', $distance);
            }

            $barbecues = $barbecues->orderBy('distance', 'asc');
        }

        if ($time === 'week') {
            $barbecues = $barbecues->where('created_at', '>=', now()->subWeek());
        } elseif ($time === 'month') {
            $barbecues = $barbecues->where('created_at', '>=', now()->subMonth());
        } elseif ($time === 'semester') {
            $barbecues = $barbecues->where('created_at', '>=', now()->subMonths(6));
        }

        if ($search) {
            $barbecues = $barbecues->where('title', 'like', "%$search%");
        }

        return response()->json($barbecues->get());
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
        $barbecue = Barbecue::findOrFail($id);
        $barbecue = Barbecue::with('basket')->with('basket.basketProduct')->with('basket.basketProduct.product')->find($id);
        
        return Inertia::render('Barbecues/Show', [
            'barbecue' => $barbecue,
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
}
