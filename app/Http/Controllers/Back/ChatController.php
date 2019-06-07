<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class ChatController extends Controller
{
    function __construct()
    {
        $this->middleware('authCheck');
    }

    /**
     * 聊天界面(数据处理)
     * @Author   Yexk       <yexk@yexk.cn>
     * @DateTime 2017-08-10
     * @param    Request    $request              [description]
     * @return   [type]                           [description]
     */
    public function chats(Request $request)
    {
        if ($request->ajax())
        {
            if ('1' == $request->get('user'))
            {
                $userlists = Redis::smembers('userlists');
                $user = User::whereIn('id',$userlists)->get();
                return $user;
            }

            return 0;
        }

        $chat_group1 = Redis::lrange('chat_group1',0,999999999999);


    	return view('back/chat/chats',['chat'=>$chat_group1,'id'=>session('YEXK_USERINFO_ID')]);
    }


}
