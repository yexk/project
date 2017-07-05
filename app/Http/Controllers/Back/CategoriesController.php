<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Category;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
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
        if (!$request->method('post'))
        {
            abort(404);
        }

        return Categories::insertData($request);

    }

    public function lists()
    {
        $cate = Categories::getAll(['id','name','pid']);
    	return view('back/categories/lists',['cate' => $cate]);
    }

}
