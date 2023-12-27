<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use App\Models\Message;


class MessageController extends Controller
{
    public function message(MessageRequest $request)
    {
        $request = $request->validated();
        try {
            Message::create($request);
            return redirect()->back()->with("message", "Your message has been sent.");
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
}
