<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\BaseController;
use App\Http\Requests\Message\MainMessageRequest;
use App\Http\Requests\Message\PageMessageRequest;
use App\Models\StoreMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends BaseController
{
    public function index(){
        $messages = StoreMessage::where('from_id', Auth::user()->id)->orWhere('to_whom_id', Auth::user()->id)->get();
        $users_list = $this->service->users_list($messages);
        $user_messages = $this->service->user_messages($users_list);
        return view('messages.messages', compact('users_list', 'user_messages'));
    }

    public function user_page_send($user, $user_from, PageMessageRequest $request){
        $data = $request->validated();
        $this->service->user_page_send($user, $user_from, $data);
        return redirect(asset('/users/'.$user));
    }

    public function send(MainMessageRequest $request){
        $data = $request->validated();
        $this->service->send($data);
        return redirect(asset('/messages'));
    }
}
