<?php

namespace App\Http\Controllers\Back;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailsController extends Controller
{
    function __construct()
    {
        $this->middleware('authCheck');
    }

    public function inbox()
    {
//        Mail::to('yexk@carystudio.com')->queue(new SendMessage());
//        dispatch(new SendEmail($res,'yexk@carystudio.com','hahhh','sdkfghaskfhalfhajklgfslgfa'));
        return view('back/email/inbox');
    }

    /**
     * 发邮箱
     * @param Request $request
     * @Author  Yexk
     * @date 2017年7月29日
     * @return object
     */
    public function sendMail(Request $request)
    {
        $data = [];
        $data['to'] = explode(';',$request->to);
        $data['cc'] = $request->cc;
        $data['bcc'] = $request->bcc;
        $data['subject'] = $request->subject;
        $data['message'] = $request->message;

//        dump($data);
        return dispatch(new SendEmail($data));
    }

}
