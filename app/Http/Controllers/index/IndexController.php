<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Request $request)
    {
    	echo "1";
        echo $request->getClientIp();
        dd($GLOBALS);

    }
}
