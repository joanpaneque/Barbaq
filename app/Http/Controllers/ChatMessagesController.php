<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Events\Message as MessageEvent;

class ChatMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ChatMessage::all();
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
    public function store(Request $request, string $barbecueId)
    {
        $chatMessage = new ChatMessage();
        $chatMessage->user_id = auth()->user()->id;
        $chatMessage->barbecue_id = $barbecueId;
        $chatMessage->message = $request->message;
        $chatMessage->save();

        $chatMessage->load('user');

        MessageEvent::dispatch($chatMessage);

        return $chatMessage;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function apiShow(string $id)
    {
        return ChatMessage::find($id);
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
