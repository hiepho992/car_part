<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryValidate extends FormRequest
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
            'name' => 'required|unique:categories,name,NULL,id,deleted_at,NULL'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Thông tin không được bỏ trống',
            'name.unique' => 'Thông tin đã bị trùng'
        ];
    }
}
