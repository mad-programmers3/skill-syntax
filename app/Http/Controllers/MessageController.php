<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Validator;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => 'Validation error',
                'messages' => $validator->errors()
            ], 400);
        }

        try {
            // Create a new message
            $message = Message::create([
                'user_id' => Auth::id(), // Assuming user_id is the currently authenticated user
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully',
                'data' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Server error, please try again later.'
            ], 500);
        }
    }

    public function getMessages()
    {
        // Retrieve all messages with the associated user information
        $messages = Message::with('user')->get();

        // Retrieve all sent messages for the authenticated user
        $sentMessages = Message::where('user_id', Auth::id())->get();

        return response()->json([
            'messages' => $messages, // All incoming messages
            'sentMessages' => $sentMessages // All sent messages
        ], 200);
    }

    public function deleteMessage($id)
    {
        // Find the message by ID
        $message = Message::find($id);

        if (!$message) {
            return response()->json([
                'success' => false,
                'error' => 'Message not found'
            ], 404);
        }

        // Check if the authenticated user is the owner of the message
        if ($message->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'error' => 'Unauthorized to delete this message'
            ], 403);
        }

        try {
            // Delete the message
            $message->delete();

            return response()->json([
                'success' => true,
                'message' => 'Message deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Server error, please try again later.'
            ], 500);
        }
    }
}
