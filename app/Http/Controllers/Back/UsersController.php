<?php
/**
 * 用户管理控制器
 */
namespace App\Http\Controllers\Back;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * 列表展示
     * @Author   Yexk       <yexk@yexk.cn>
     * @DateTime 2017-07-24
     * @param    Request    $request              [description]
     * @return   null                           [description]
     */
    public function lists(Request $request)
    {
        $user = User::all();
        return view('back/users/lists',['user'=>$user]);
    }

    /**
     * 用户添加
     * @Author   Yexk       <yexk@yexk.cn>
     * @DateTime 2017-07-24
     * @param    Request    $request              [description]
     * @return   Object
     */
    public function add(Request $request)
    {
        $this->validate($request,[
            "username" => "required|distinct",
            "password" => "required",
        ],[
            "username" => "用户名必须输入！",
            "password" => "密码必须输入！",
        ]);

        return User::insertData($request);
    }
}
