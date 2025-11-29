<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function dashboard()
    {
        // Get all users we have messages with
        $userIds = Message::where('from_id', auth()->id())
            ->orWhere('to_id', auth()->id())
            ->pluck('from_id', 'to_id')->flatten()->unique()->filter(function ($id) {
                return $id != auth()->id();
            });

        $users = User::whereIn('id', $userIds)->get();

        // Add latest message and unread count
        $users->map(function ($user) {
            $user->latest_message = Message::where(function ($q) use ($user) {
                $q->where('from_id', auth()->id())->where('to_id', $user->id);
            })->orWhere(function ($q) use ($user) {
                $q->where('from_id', $user->id)->where('to_id', auth()->id());
            })->latest()->first();

            $user->unread_count = Message::where('from_id', $user->id)
                ->where('to_id', auth()->id())
                ->where('read_at', null)
                ->count();

            return $user;
        });

        return view('chat.chat-dashboard', compact('users'));
    }


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

        return view('chat.chat-user', compact('recipient', 'messages'));
    }

    public function conversations()
    {
        $userId = auth()->id();

        // Get IDs of users you have messages with
        $sentTo = Message::where('from_id', $userId)->pluck('to_id');
        $receivedFrom = Message::where('to_id', $userId)->pluck('from_id');

        $userIds = $sentTo->merge($receivedFrom)->unique();

        $users = User::whereIn('id', $userIds)->get();

        // Include latest message for preview
        $users->transform(function ($user) use ($userId) {
            $latestMessage = Message::where(function ($q) use ($userId, $user) {
                $q->where('from_id', $userId)->where('to_id', $user->id);
            })->orWhere(function ($q) use ($userId, $user) {
                $q->where('from_id', $user->id)->where('to_id', $userId);
            })->latest()->first();

            $user->latest_message = $latestMessage;
            $user->unread_count = Message::where('from_id', $user->id)
                ->where('to_id', $userId)
                ->whereNull('read_at')
                ->count();

            return $user;
        });

        return view('chat.chat-dashboard', compact('users'));
    }
}
