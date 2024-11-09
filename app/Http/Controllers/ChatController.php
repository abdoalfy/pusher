<?php

namespace App\Http\Controllers;

use App\Events\ChatSent;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendmessageview(Request $request,$userId){
        $user=User::where('id',$userId)->first();
        return view('chat', compact('user'));
    }

    public function sendmessage(Request $request, $userId)
    {
        $user = User::find($userId); // Get the recipient user by ID
    
        $data = [
            'sender_id' => auth()->user()->id,     // Authenticated user as sender
            'reciver_id' => $user->id,            // Recipient user from URL
            'message' => $request->message,        // Message from the request
        ];
    
        // Create a new chat message
        $chat = Chat::create($data);    
        $reciver = User::find($userId);
        if ($chat) {
            broadcast(new ChatSent($reciver,$user->id,$request->message));
        }
        return response()->json('Message sent successfully');
    }
    
}

