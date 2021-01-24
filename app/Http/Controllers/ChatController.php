<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use App\Events\NewChatMessage;

class ChatController extends Controller
{
    //return all rooms
    public function rooms(Request $request) {
        return ChatRoom::all();
    }
    //return all messages for a room
    public function messages(Request $request, $roomId) {
        return ChatMessage::where('chat_room_id',$roomId)
            ->with('user')
            ->orderBy('created_at','DESC')
            ->get();
    }

    public function newMessage(Request $request, $roomId){
        $newMessage = new ChatMessage;
        $newMessage->user_id = Auth::id();
        $newMessage->chat_room_id = $roomId;
        $newMessage->message = $request->message;
        $newMessage->save();

        broadcast(new NewChatMessage( $newMessage ))->toOthers(); //send events to another people(not current user)
        return $newMessage;
    }

    public function newRoom(Request $request) {
        $this->validate($request, [
            'name' => 'required| unique:chat_rooms'
        ]);
        $newRoom = new ChatRoom;
        $newRoom->user_id = Auth::id();
        $newRoom->name = $request->name;
        $newRoom->save();
        return $newRoom;
    }
}
