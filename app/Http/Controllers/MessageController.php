<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            // Create and save the message
            $message = new Message();
            $message->email = $request->email;
            $message->subject = $request->subject;
            $message->message = $request->message;
            $message->save();

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully.'
            ], 200);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Message send error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while sending the message.'
            ], 500);
        }
    }

    public function getMessages()
    {
        // Retrieve all messages or apply any necessary filters
        $messages = Message::all(); // Or paginate if needed

        return response()->json(['messages' => $messages], 200);
    }



}
