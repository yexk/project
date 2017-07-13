<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class backAuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        判断是否登陆。如果登陆了就返回home
        if ( empty(session('YEXK_USERINFO_ID')) )
        {
            return response()->redirectToRoute('/');
        }
//        elseif( $cookie = $request->cookie('YEXK_USER') ){
//            dd(1);
//            if ( !$this->setSession($request,$cookie) )
//            {
//                return response()->redirectToRoute('/');
//            }
//        }
        return $next($request);
    }


    /**
     * 如果浏览器存储了cookie，就去数据库读出当前用户的资料存到session
     * @Author  Yexk
     * @return  Boolean   返回设置状态
     */
    public function setSession($request,$cookie)
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
}
