<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $session_user_id = $request->session()->get('YEXK_USERINFO_ID');
            $cookie = $request->cookie('YEXK_USER');
            if (!empty($session_user_id))
            {
                // has session
                return response()->redirectToRoute('home');
            }else{
                // has not session bug has cookie
                if( !empty($cookie) || !empty(json_encode($cookie)->id) ){
                    if ( $this->setSession($request,$cookie) )
                    {
                        return response()->redirectToRoute('home');
                    }
                }
            }
            return $next($request);
        });
    }

    /**
     * 如果浏览器存储了cookie，就去数据库读出当前用户的资料存到session
     * @Author  Yexk
     * @return  Boolean   返回设置状态
     */
    private function setSession($request,$cookie)
    {
        $cookie = json_decode($cookie);
        $user_info = User::where('username',$cookie->username)->where('email',$cookie->email)->where('status',1)->first();
        if($user_info)
        {
            unset($user_info->password);
            // 设置session
            $request->session()->put('YEXK_USERINFO',json_encode($user_info));
            $request->session()->put('YEXK_USERINFO_ID',$user_info->id);
            return true;
        }else{
            return false;
        }
    }

    public function index()
    {

    	return view('back/login');
    }

    /**
     * 检测用户登陆（并且设置cookie和session）
     * @Author   Yexk       <yexk@yexk.cn>
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
