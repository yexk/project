<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    function __construct()
    {
       $this->middleware('authCheck',['index']);
    }
    
    public function index()
    {
    	return view('back/home');
    }
}
