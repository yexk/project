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
    function __construct()
    {
        $this->middleware('authCheck');
    }

    /**
     * 列表展示
     * @Author   Yexk       <yexk@yexk.cn>
     * @DateTime 2017-07-24
     * @param    Request    $request              [description]
     * @return   null                           [description]
     */
    public function lists(Request $request)
    {
        $user = User::where('status','<>' ,'0')->get();
        return view('back/users/lists',['user'=>$user]);
    }

    /**
     * 用户添加和修改
     * @Author   Yexk       <yexk@yexk.cn>
     * @DateTime 2017-07-24
     * @param    Request    $request              [description]
     * @return   Object
     */
    public function add(Request $request)
    {

        if ($request->ajax() && 1 == $request->get('modifypassword')) {
            return User::modifyPassword($request);
        }elseif (1 == $request->get('userdel')) {
            return User::deleteUser($request);
        }

        if ($request->id)
        {
            $this->validate($request,[
                "username" => "required|distinct",
            ]);
        }else{
            $this->validate($request,[
                "username" => "required|distinct",
                "password" => "required",
            ],[
                "username.required" => "用户名必须输入！",
                "password.required" => "密码必须输入！",
            ]);
        }

        return User::insertData($request);
    }
}
