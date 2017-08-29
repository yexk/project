<?php

namespace App\Http\Controllers\back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtherController extends Controller
{
    function __construct()
    {
        $this->middleware('authCheck');
    }

    public function lockScreen()
    {

        return view('back/other/lock_screen');
    }
}
