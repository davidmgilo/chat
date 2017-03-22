<?php

namespace Davidmgilo\chat\Http\Controllers;

use Davidmgilo\chat\Events\MessageSent;
use Davidmgilo\chat\Message;
use Auth;
use Illuminate\Http\Request;

/**
 * Class ChatController
 * @package Davidmgilo\chat\Http\Controllers
 */
class ChatController extends Controller
{
    //
    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        return view('chat',$data);
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return array
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        //Broadcast

        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }

    public function fetchMessages()
    {
        //Lazy loading -> Eager Loading
        return Message::with('user')->get();
    }

}
