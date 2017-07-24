<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'users';

    protected $fillable = ['name','username','password','email','register','last_login'];

    protected $hidden = ['password'];

    /**
     * 判断用户名和密码是否正确
     * @Author   Yexk       <yexk@yexk.cn>
     * @DateTime 2017-07-12
     * @param    [type]     $request              [description]
     * @return   Boolean|Object                   [失败返回false，成功返回登陆信息]
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

    /**
     * 添加用户数据
     * @param $request
     * @Author  Yexk <yexk@yexk.cn>
     * @DateTime 2017-07-24
     * @return array
     */
    public static function insertData($request)
    {
        $result = [ 'code' => '0' , 'msg'=> '未知错误！' , 'data' => '' ];
        if (null == $request)
        {
            return $result;
        }

        if( self::where('username',trim($request->username))->first() )
        {
            $result['msg'] = '用户已被占用。请使用别的用户名';
            return $result;
        }


        $data = [];
        $data['name'] = $data['username'] = trim($request->username);
        $data['password'] = encrypt(trim($request->password));
        $data['email'] = 0;
        $data['register'] = $data['last_login'] = date('Y-m-d H:i:s');
        $res = self::create($data);
        if ($res)
        {
            $result['code'] = '1';
            $result['msg'] = '添加成功！';
        }

        return $result;
    }

}
