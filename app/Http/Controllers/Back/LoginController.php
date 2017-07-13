<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    function __construct()
    {
//        $this->middleware('authCheck',['index']);
    }


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
        if ( $user_info = User::loginCheck($request) )
        {
            // 设置cookie和其他业务逻辑
            $request->session()->put('YEXK_USERINFO',json_encode($user_info));
            $request->session()->put('YEXK_USERINFO_ID',$user_info->id);

            $cookie = cookie('YEXK_USER',false,10080);
            if ('remember' == $request->get('remember'))
            {
                $cookie = cookie('YEXK_USER',json_encode($user_info),10080);
            }

            return response()->redirectToRoute('home')->withCookie($cookie);
        }
        else
        {
            return redirect()->route('/');
        }

    }

}
