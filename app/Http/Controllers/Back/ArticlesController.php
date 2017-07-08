<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Article;
use App\Models\Articles;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    //
    public function add()
    {
        $cate = Categories::getAll(['id','name','pid']);
        return view('back/articles/add' , ['cate' => $cate]);
    }


    public function store(Article $request)
    {
        return Articles::insertData($request);
    }

}
