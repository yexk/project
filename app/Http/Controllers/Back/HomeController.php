<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    function __construct()
    {
       $this->middleware('authCheck');
    }
    
    public function index()
    {
    	return view('back/home');
    }

    /**
     * logout operation
     *
     * @param Request $request
     * @date 2017-7-29
     * @Author  Yexk
     * @return $this goto login url
     */
    public function logout(Request $request)
    {
        $request->session()->forget('YEXK_USERINFO');
        $request->session()->forget('YEXK_USERINFO_ID');
        $request->session()->flush();
        $cookie = Cookie::forget('YEXK_USER');
        return response()->redirectToRoute('/')->withCookie($cookie);
    }
}
