<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Auth;

class MessageBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web'); //use the web guard
    }

    public function messageBoard()
    {
        $messages = Message::latest()->take(100)->with('user')->paginate(15);
        return view('message-board', compact('messages'));
    }

    public function submit(Request $request)
    {
        $this->validate($request,[
            "message"=>['required']
        ]);

        $user = Auth::user();
        $message = new Message;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->save();

        return $this->messageBoard();
    }
}
