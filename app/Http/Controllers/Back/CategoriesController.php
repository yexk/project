<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Category;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    function __construct()
    {
       $this->middleware('authCheck');
    }

    
    /**
     * 显示添加的页面
     * @Author   Yexk       <yexk@carystudio.com>
     * @DateTime 2017-07-05
     */
    public function add()
    {
        $cate = Categories::getAll(['id','name','pid']);
        return view( 'back/categories/add', ['cate' => $cate] );
    }
    
    /**
     * 添加文章分类
     * @Author Yexk       <yexk@yexk.cn>
     * @Date   2017-07-05
     * @param  Category   $request       表单验证后的数据
     * @return object                    状态
     */
    public function store(Category $request)
    {
        return Categories::insertData($request);
    }

    /**
     * 显示分类列表
     * @Author   Yexk       <yexk@carystudio.com>
     * @DateTime 2017-07-08
     * @return   Object     返回视图
     */
    public function lists()
    {
        $cate = Categories::getAll(['id','name','pid','description']);
    	return view('back/categories/lists',['cate' => $cate]);
    }

    /**
     * 修改和编辑操作。
     * @Author   Yexk       <yexk@carystudio.com>
     * @DateTime 2017-07-08
     * @param    Request    $request              请求对象
     * @return   Object                           返回结果（状态）
     */
    public function edits(Request $request)
    {
        if ('true' === $request->get('_delete'))
        {
            // 删除
            if ('true' === $request->get('_force'))
            {
                return Categories::setDelete($request,true);
            }else
            {
                return Categories::setDelete($request);
            }

        }
        else
        {
            // 修改
            $this->validate($request, [
                'edit_id' => 'required',
                'edit_cate_name' => 'required|max:255',
            ],[
                'edit_cate_name' => '分类名称必须！',
            ]);

            return Categories::updateData($request);
        }


    }

}
