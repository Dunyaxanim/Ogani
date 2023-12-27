<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function mailbox(){
        $messages =  Message::all();
        return view('admin.pages.mailbox.inbox',['messages'=> $messages]);
    }
}
