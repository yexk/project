<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Article;
use App\Models\Articles;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    function __construct()
    {
       $this->middleware('authCheck',['index']);
    }
    
    //
    public function add()
    {
        $cate = Categories::getAll(['id','name','pid']);
        return view('back/articles/add' , ['cate' => $cate]);
    }

    /**
     * 添加文章
     * @Author   Yexk       <yexk@carystudio.com>
     * @DateTime 2017-07-10
     * @param    Article    $request              文章请求数据
     * @return   Object                           返回状态
     */
    public function store(Article $request)
    {
        return Articles::insertData($request);
    }

    /**
     * 文章列表展示，还要里面的操作（删除，查看）
     * @Author   Yexk       <yexk@carystudio.com>
     * @DateTime 2017-07-11
     * @param    Request    $request              [description]
     * @return   [type]                           [description]
     */
    public function lists(Request $request)
    {
        if ($request->ajax())
        {
            if ('1' == $request->get('getOne')){
                // 获取一条数据 （用于预览）
                return Articles::select('title','content','public_at','label_id')->find($request->id);

            }elseif ('1' == $request->get('delOne')){
                // 删除一条数据（用于软删除）
                return Articles::softDelOne($request);

            }elseif ('1' == $request->get('getAll')){
                // 获取所有数据 （用于展示列表）
                return Articles::getDataTableDatas($request);

            }
        }

        return view('back/articles/lists');
    }

    /**
     * 编辑视图的显示，还有编辑的数据的保存
     * @Author   Yexk       <yexk@carystudio.com>
     * @DateTime 2017-07-11
     * @param    Request    $request              [description]
     * @param    [type]     $id                   [description]
     * @return   [type]                           [description]
     */
    public function edited(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('POST'))
        {
            return Articles::updateData($request);
        }

        $art_data = Articles::find($id);
        if (empty($art_data))
        {
            abort('404');
        }

        $cate = Categories::getAll(['id','name','pid']);
        return view('back/articles/edited' , ['cate' => $cate,'art'=>$art_data]);
    }

}
