<?php

namespace App\Http\Middleware;

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
        return $next($request);
    }
}
