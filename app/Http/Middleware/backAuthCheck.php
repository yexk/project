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
        
        return $next($request);
    }

}
