<?php

namespace App\Http\Controllers\Chat;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chatPage(Request $request)
    {
        $user = User::all();
        $id = $request->input('id');
        $userId = Auth::user()->id;
        $messages = Message::where(function ($query) use ($userId, $id) {
            $query->where('user_id', $userId)
                ->where('reciver_id', $id);
        })->orWhere(function ($query) use ($userId, $id) {
            $query->where('user_id', $id)
                ->where('reciver_id', $userId);
        })->get();
        return view('chat-page.index', compact('messages','user','id'));
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $u = User::find(Auth::user()->id);
        $user = $u->name;
        $reciver_id =$request->input('reciver');
        $m = new Message();

        // Set the user_id, content, and receiver_id values
        $m->user_id = Auth::user()->id;
        $m->content = $request->input('message');
        $m->reciver_id = $reciver_id;
        $m->save();

        $message = $request->input('message');
        
        if ($user && $message) {
            $success = true;
        } else {
            $success = false;
        }
        event(new MessageSent($message, $user, $success));



        return response()->json(['status' => $user . $message]);
    }
}
