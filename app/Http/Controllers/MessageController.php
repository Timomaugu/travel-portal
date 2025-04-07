<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;

class MessageController extends Controller
{
   
    public function findUsers(Request $request) {
        $users = User::where('f_name', 'LIKE', '%'.$request->search.'%')
            ->orWhere('l_name', 'LIKE', '%'.$request->search.'%')
            ->where('id', '<>', auth()->id())
            ->get();
        return response()->json($users);
    }

    public function getMessages($id)
    {
        $lastId = Conversation::get()->max('id') + 1;
        if($id == 'undefined') {
            echo '<div>Send a Message to start a chat</div>
                    <input type="hidden" class="conversation_id" value="'.$lastId.'">';
            return;
        }
        $selectedConversation = selectedConversation($id);

        foreach ($selectedConversation->messages as $message) {
            if ($message->sender_id != auth()->id()) {
                // message seen
                $message->read_at = now();
                $message->save();

                echo '<div class="message media reply">
                        <figure class="user--online">
                            <a href="#">
                                <img src="'.asset('assets/images/admin.png').'" class="rounded-circle" alt="">
                            </a>
                        </figure>
                        <div class="message-body media-body">
                            <p>'.$message->text. '</p>
                            <small>'.$message->created_at->format('d M h:i a').'</small>
                        </div>
                    </div>';
            }
            else {
                echo '<div class="message media">
                        <figure class="user--online">
                            <a href="#">
                                <img src="'.asset('assets/images/user.png').'" class="rounded-circle" alt="">
                            </a>
                        </figure>
                        <div class="message-body media-body">
                            <p>'.$message->text. '</p>
                            <small>'.$message->created_at->format('d M h:i a'). '</small>
                        </div>
                    </div>';
            }

        }
        echo '<input type="hidden" class="conversation_id" value="'.$selectedConversation->id.'">';
        echo '<input type="hidden" class="receiver_id" value="'.$selectedConversation->receiver_id.'">';
    }

    public function sendMessage(Request $request)
    {  
        $conversation = Conversation::find($request->conversation_id);

        if(!$conversation) {
            Conversation::create([
                'id' => $request->conversation_id,
                'sender_id' => auth()->id(),
                'receiver_id' => $request->receiver_id,
            ]);
        }

        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'text' => $request->message,
        ]);

        return response()->json($message);
    }
}
