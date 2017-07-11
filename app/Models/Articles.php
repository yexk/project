<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    //
	protected $table = "articles";

	protected $primaryKey = 'id';

    protected $fillable = ['cate_id','title','content','desc','label_id','user_id','public_at'];

    protected $hidden = ['categories','userInfo'];

    /**
     * 定义模型关联分类表
     * @Author  Yexk
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo('App\Models\Categories','cate_id');
    }

    /**
     * 定义模型关联用户表
     * @Author  Yexk
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userInfo()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    /**
     * 添加文章数据
     * @Author   Yexk       <yexk@carystudio.com>
     * @DateTime 2017-07-11
     * @param    Object     $request              请求数据
     * @return   Array                            状态信息
     */
	public static function insertData($request)
    {
        $result = [ 'code' => '0' , 'msg'=> '未知错误！' , 'data' => '' ];
        if (null == $request)
        {
            return $result;
        }

        $data = [];
        $data['cate_id'] = $request->cate_id;
        $data['title'] = htmlspecialchars($request->title);
        $data['content'] = htmlspecialchars($request['content-markdown-doc']);
        $data['desc'] = $request->description ? htmlspecialchars($request->description) : '';
        $data['label_id'] = $request->label ? htmlspecialchars($request->label) : '' ;
        $data['user_id'] = 1;
        $data['public_at'] = $request->public_at ? $request->public_at : date('Y-m-d H:i');
        $res = self::create($data);
        if ($res)
        {
            $result['code'] = '1';
            $result['msg'] = '添加成功！';
        }

        return $result;
    }

    /**
     * 更新文章数据
     * @Author   Yexk       <yexk@carystudio.com>
     * @DateTime 2017-07-11
     * @param    Object     $request              请求数据
     * @return   Array                            状态信息
     */
	public static function updateData($request)
    {
        $result = [ 'code' => '0' , 'msg'=> '未知错误！' , 'data' => '' ];
        if (null == $request)
        {
            return $result;
        }

        $art = self::find($request->art_id);
        $art->cate_id = $request->cate_id;
        $art->title = htmlspecialchars($request->title);
        $art->content = htmlspecialchars($request['content-markdown-doc']);
        $art->desc = $request->description ? htmlspecialchars($request->description) : '';
        $art->label_id = $request->label ? htmlspecialchars($request->label) : '' ;
        $art->user_id = 1;
        $art->public_at = $request->public_at ? $request->public_at : date('Y-m-d H:i');
        $res = $art->save();
        if ($res)
        {
            $result['code'] = '1';
            $result['msg'] = '更新成功！';
        }

        return $result;
    }

    /**
     * 获取文章用于列表展示。（携带标题搜索功能）
     * @Author   Yexk       <yexk@carystudio.com>
     * @DateTime 2017-07-11
     * @param    Object     $request              请求数据
     * @return   Array                            状态信息
     */
    public static function getDataTableDatas($request)
    {
        $res_data = $request->all();
        $data = [];
        $data['draw'] = $res_data['draw'] ? $res_data['draw'] : 1;
        $data['recordsTotal'] = self::select('id')->count();

        $sql_where = self::select('id','cate_id','title','user_id','status','label_id','public_at','created_at','updated_at')
                        ->where(function($query) use ($res_data){
                            if(!empty($res_data['search']['value'])){
                                $query->where('title','like', '%'.$res_data['search']['value'].'%' );
                            }
                        });
        $data['recordsFiltered'] = $sql_where->count();

        $data['data'] = $sql_where->offset($res_data['start'])->limit($res_data['length'])->orderBy('created_at','DESC')->get()->each(function ($item) {
                            $item['user_id'] = $item->userInfo->name;
                            $item['cate_id'] = $item->categories->name;
                            $item['edited'] = route('art.edited',['id'=>$item->id]);
                        });

        return json_encode($data);

    }

    /**
     * 删除数据。改变状态值。（软删除）
     * @Author   Yexk       <yexk@carystudio.com>
     * @DateTime 2017-07-11
     * @param    Object     $request              请求数据
     * @return   Array                            状态信息
     */
    public static function softDelOne($request)
    {
        $result = [ 'code' => '0' , 'msg'=> '未知错误！' , 'data' => '' ];
        if (null == $request && empty($request->id))
        {
            return $result;
        }

        $res_data = self::find($request->id);
        $res_data->status = 0;
        $res = $res_data->save();
        if ($res)
        {
            $result['code'] = '1';
            $result['msg'] = '删除成功！';
        }

        return $result;

    }

}
