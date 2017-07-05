<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Category extends FormRequest
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
            'name' => 'required|max:255',
            'pid' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '分类名称不能为空！',
            'pid' => '父级分类必选！',
        ];
    }
}
