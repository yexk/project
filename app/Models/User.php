<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'users';

    protected $hidden = ['password'];

    /**
     * 判断用户名和密码是否正确
     * @Author   Yexk       <yexk@carystudio.com>
     * @DateTime 2017-07-12
     * @param    [type]     $request              [description]
     * @return   [type]                           [失败返回false，成功返回登陆信息]
     */
    public static function loginCheck($request)
    {
        if ( empty($request->username) || empty($request->password) )
        {
            return false;
        }
        $username = trim($request->username);
        $password = trim($request->password);
        $user_info = self::where('username',$username)->where('status',1)->orWhere('email',$username)->first();
        if ($user_info)
        {
            if ($password === decrypt($user_info->password))
            {
                unset($user_info['password']);
                return $user_info;
            }
        }

        return false;
    }
}
