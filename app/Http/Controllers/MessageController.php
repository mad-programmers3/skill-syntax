<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $validatedData = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $validatedData['receiver_id'],
            'message' => $validatedData['message'],
        ]);

        return response()->json(['success' => true, 'message' => 'Message sent successfully!', 'data' => $message]);
    }

    public function getMessages($userId)
    {
        // Get messages for the authenticated user with the specified userId
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('receiver_id', Auth::id())
                ->where('sender_id', $userId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json(['success' => true, 'data' => $messages]);
    }
}

