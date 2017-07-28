<?php

namespace App\Http\Controllers\Back;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailsController extends Controller
{

    public function inbox()
    {
        return view('back/email/inbox');
    }

    /**
     * 发邮箱
     * @param Request $request
     * @Author  Yexk
     */
    public function sendMail(Request $request)
    {

        dispatch(new SendEmail(['name'=>'yexk']));
    }

}
