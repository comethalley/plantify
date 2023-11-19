<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class ChatController extends Controller
{
    public function send (Request $request)
    {
        $data = $request->validate([
            'message'  => 'required|string|max:55',
            
        ]);
        $message = Message::create([
            'message'  => $data['message'],
            
        ]);

        return response(compact('message'));
    }
}
