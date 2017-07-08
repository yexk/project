<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Article extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cate_id' => 'required',
            'title' => 'required|max:255',
            'content-markdown-doc' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cate_id' => '文章分类必选！',
            'title.required' => '标题不能为空！',
            'content-markdown-doc' => '文章内容不能为空！',
        ];
    }
}
