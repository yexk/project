<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

	protected $table = "Categories";
    
    /**
     * 可以被批量赋值的属性。
     * @var array
     */
    protected $fillable = ['pid','name','description'];

    /**
     * 添加数据，保存到数据库
     * @Author Yexk       <yexk@yexk.cn>
     * @Date   2017-07-05
     * @param  Object     $post          表单数据
     * @return Object                    状态
     */
	public static function insertData($post = null)
    {
        $result = [ 'code' => '0' , 'msg'=> '未知错误！' , 'data' => '' ];
        if (null == $post)
        {
            return $result;
        }

    	$data = [];
    	$data['pid'] = $post->pid;
    	$data['name'] = $post->name;
    	$data['description'] = $post->description;
        $res = self::create($data);
        if ($res)
        {
            $result['code'] = '1';
            $result['msg'] = '添加成功！';
        }

        return $result;
    }
}
