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
     * 添加用户数据 和 修改用户
     * @param $request
     * @Author  Yexk <yexk@yexk.cn>
     * @DateTime 2017-07-24
     * @return array
     */
    public static function insertData($request)
    {
        $result = ['code' => '0', 'msg' => '未知错误！', 'data' => ''];
        if (null == $request) {
            return $result;
        }

        $res = [];
        if ($request->id)
        {
            if (self::where('id','<>',$request->id)->where('username', trim($request->username))->first()) {
                $result['msg'] = '用户已被占用。请使用别的用户名';
                return $result;
            }
            $user_info = self::where('status','1')->where('id',$request->id)->first();
            if ($user_info)
            {
                $request->password ? $user_info->password = encrypt(trim($request->password)) : '';
                $user_info->name     =  trim($request->name);
                $user_info->username = trim($request->username);
                $user_info->email    = trim($request->email);
                $res = $user_info->update();
            }
        }else{
            if (self::where('username', trim($request->username))->first()) {
                $result['msg'] = '用户已被占用。请使用别的用户名';
                return $result;
            }
            $data = [];
            $data['name'] = $data['username'] = trim($request->username);
            $data['password'] = encrypt(trim($request->password));
            $data['email'] = 0;
            $data['register'] = $data['last_login'] = date('Y-m-d H:i:s');
            $res = self::create($data);
        }

        if ($res && $request->id){
            $result['code'] = '1';
            $result['msg'] = '添加成功！';
        }else {
            $result['code'] = '1';
            $result['msg'] = '添加成功！';
        }

        return $result;
    }

    /**
     * 根据旧密码设置新密码
     *
     * @param $request
     * @Author  Yexk <yexk@yexk.cn>
     * @DateTime 2017-07-27
     * @return array
     */
    public static function modifyPassword($request)
    {
        $result = [ 'code' => '0' , 'msg'=> '未知错误！' , 'data' => '' ];
        if (null == $request)
        {
            return $result;
        }
        $modify_user = self::where('id',$request->id)->where('status',1)->first();
        if ($request->oldpassword === decrypt($modify_user->password))
        {
            $modify_user->password = encrypt($request->newpassword);
            $res = $modify_user->update();
            if ($res)
            {
                $result['code'] = '1';
                $result['msg'] = '密码修改成功！';
            }
        }else{
            $result['msg'] = '原密码输入错误！';
        }

        return $result;
    }



    /**
     * 删除用户
     *
     * @param $request
     * @Author  Yexk <yexk@yexk.cn>
     * @DateTime 2017-07-27
     * @return array
     */
    public static function deleteUser($request)
    {
        $result = [ 'code' => '0' , 'msg'=> '未知错误！' , 'data' => '' ];
        if ( 1 == $request->id || null == $request)
        {
            return $result;
        }
        $modify_user = self::where('id',$request->id)->where('status',1)->first();
        if ($modify_user)
        {
            $modify_user->status = 0;
            $res = $modify_user->update();
            if ($res)
            {
                $result['code'] = '1';
                $result['msg'] = '密码修改成功！';
            }
        }
        return $result;
    }

    /**
     * 更新用户最后登录的ip地址
     *
     * @param $request
     * @Author  Yexk <yexk@yexk.cn>
     * @DateTime 2017-8-10
     * @return array
     */
    public static function setUserIp($userid = '',$ip = '')
    {
        $user = self::find($userid);
        $user->last_login_ip = $ip;
        $user->save();
    }


}
