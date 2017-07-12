<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index()
    {
    	return view('back/login');
    }

    /**
     * 检测用户登陆（并且设置cookie和session）
     * @Author   Yexk       <yexk@carystudio.com>
     * @DateTime 2017-07-12
     * @param    Request    $request              [表单数据]
     * @return   [type]                           [跳转]
     */
    public function loginCheck(Request $request)
    {
        // 登陆判断，设置cookie，session
        if ( User::loginCheck($request) )
        {
            // 设置cookie和其他业务逻辑
            return redirect()->route('home');
        }
        else
        {
            return redirect()->route('/');
        }

    }

}
