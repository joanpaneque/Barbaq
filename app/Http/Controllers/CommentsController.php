<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;

class CommentsController extends Controller
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
        $comment_id = $request->input('comment_id');
        $barbecue_id = $request->input('barbecue_id');
        $comment = $request->input('comment');
        $user_id = auth()->id();

        $created_comment = Comment::create([
            'user_id' => $user_id,
            'comment_id' => $comment_id,
            'comment' => $comment,
            'barbecue_id' => $barbecue_id,
        ]);

        $created_comment['user'] = auth()->user();

        return response()->json($created_comment, 200);
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
}
