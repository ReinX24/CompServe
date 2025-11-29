<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $message = Message::create([
            'from_id' => auth()->id(),
            'to_id' => $request->to_id,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message));

        return response()->json($message);
    }

    public function showChat($userId)
    {
        $recipient = User::findOrFail($userId);

        // Fetch conversation
        $messages = Message::where(function ($q) use ($userId) {
            $q->where('from_id', auth()->id())->where('to_id', $userId);
        })->orWhere(function ($q) use ($userId) {
            $q->where('from_id', $userId)->where('to_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        return view('chat', compact('recipient', 'messages'));
    }
}
