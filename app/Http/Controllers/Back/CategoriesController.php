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
        $cate = Categories::all(['id','name']);
        return view( 'back/categories/add', ['cate' => $cate] );
    }

    public function store(Category $request)
    {
        Categories::insertData($request);

    }
}
