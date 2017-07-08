<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    //
	protected $table = "articles";

    protected $fillable = ['cate_id','title','content','desc','label_id','user_id','public_at'];

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
        $data['label_id'] = $request->label_id ? $request->label_id : '' ;
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

}
