<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Monolog\Handler\IFTTTHandler;

class ChatController extends Controller
{
    function __construct()
    {
        $this->middleware('authCheck');
    }

    //
    public function chats()
    {

    	return view('back/chat/chats');
    }


}
