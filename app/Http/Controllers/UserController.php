<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ChatMessage;

class UserController extends Controller
{
    //return all users
    public function users(Request $request) {
        return User::all();
    }

    public function deleteUser($userId ) {

        //first delete all user's messages

        $chatMessage = ChatMessage::where('user_id',$userId)->delete();

        $user = User::findOrFail($userId);
        $user->delete();

        return back()->with('success','User created successfully!');
    }
}
