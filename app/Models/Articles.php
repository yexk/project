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

	public static function insertData($request)
    {
        $result = [ 'code' => '0' , 'msg'=> '未知错误！' , 'data' => '' ];
        if (null == $request)
        {
            return $result;
        }

        $data = [];
        $data['cate_id'] = $request->cate_id;
        $data['title'] = $request->title;
        $data['content'] = $request['content-markdown-doc'];
        $data['desc'] = $request->description ? $request->description : '' ;
        $data['label_id'] = $request->label ? $request->label : '' ;
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


    public static function getDataTableDatas($request)
    {
        $res_data = $request->all();
        $data = [];
        $data['draw'] = $res_data['draw'] ? $res_data['draw'] : 1;
        $data['recordsTotal'] = $data['recordsFiltered'] = self::select('id','cate_id','title','content','desc')->count();
        $data['data'] = self::select('id','cate_id','title','user_id','status','public_at','created_at','updated_at')->get()->each(function ($item, $key) {
            $item['user_id'] = $item->userInfo->name;
            $item['cate_id'] = $item->categories->name;
        });


        return json_encode($data);
    }

}
