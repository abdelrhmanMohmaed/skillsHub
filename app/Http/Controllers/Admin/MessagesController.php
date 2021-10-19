<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Mail\contactResponseMail;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{
    public function index()
    {
        $data['messages'] = Message::orderBy('id', 'DESC')->paginate(10);

        return view('admin.messages.index')->with($data);
    }
    public function show(Message $messages)
    {
        $data['message'] = $messages;

        return view('admin.messages.show')->with($data);
    }
    public function response(Message $messages, Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $receiverName = $messages->name;
        $receiverMail = $messages->email;

        Mail::to($receiverMail)
            ->send(
                new contactResponseMail($receiverName, $request->title, $request->body)
            );

        return redirect(url('dashboard/messages'));
    }
}
