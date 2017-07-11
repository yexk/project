<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

	protected $table = "categories";
    
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
    	$data['description'] = $post->description ? $post->description : '' ;
        $res = self::create($data);
        if ($res)
        {
            $result['code'] = '1';
            $result['msg'] = '添加成功！';
        }

        return $result;
    }

    public static function getAll($array)
    {
        $data = self::all($array);
        return get_tree($data);
    }

    public static function updateData($post)
    {
        $result = [ 'code' => '0' , 'msg'=> '未知错误！' , 'data' => '' ];

        $data = [];
        $data['name'] = $post->edit_cate_name;
        $data['description'] = $post->edit_cate_description ? $post->edit_cate_description : '' ;
        $res = self::where(['id'=>$post->edit_id])->update($data);
        if ($res)
        {
            $result['code'] = '1';
            $result['msg'] = '更新成功！';
        }

        return $result;
    }

    /**
     * 删除操作。强制删除使用了递归删除。
     * @Author   Yexk       <yexk@carystudio.com>
     * @DateTime 2017-07-11
     * @param    [type]     $request              [description]
     * @param    boolean    $force                [description]
     */
    public static function setDelete($request , $force = false)
    {
        $result = [ 'code' => '0' , 'msg'=> '未知错误！' , 'data' => '' ];
        if ($request->_delete)
        {
            // 强制删除自己和子集
            if ($force)
            {
                $del_sub_res = get_sub_tree(self::all(['id','pid']),$request->delete_id);
                $del_sub_id = [];
                array_push($del_sub_id,$request->delete_id);
                foreach ($del_sub_res as $v)
                {
                    array_push($del_sub_id,$v->id);
                }
                $result['data'] = self::destroy($del_sub_id);
                $result['code'] = 1;
            }
            else
            {
                $result['data'] = self::where('pid',$request->delete_id)->count(['id']);
                if (0 != $result['data'])
                {
                    $result['msg'] = '存在子级，请先处理子集';
                    $result['code'] = 2;
                }
                else
                {
                    $result['data'] = self::destroy($request->delete_id);
                    $result['code'] = 1;
                    $result['msg'] = '删除成功！';
                }

            }
        }

        return $result;

    }

}
