<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    //
    public function lists(Request $request)
    {
        $user = User::all();
        return view('back/users/lists',['user'=>$user]);
    }
}
