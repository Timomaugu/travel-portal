<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;

class MessageController extends Controller
{
    public function createConversation(Request $request)
    {
        $conversation = Conversation::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $request->user_id,
        ]);
        
        return response()->json($conversation);
    }

    public function sendMessage(Request $request)
    {
        Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'text' => $request->message,
        ]);

        return redirect()->back()->with('success','Sent');
    }
}
