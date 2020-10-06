<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidate extends FormRequest
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
            'name' => 'required|unique:products,name,NULL,id,deleted_at,NULL',
            'category_id' => 'required',
            'maker_id' => 'required',
            'classcar_id' => 'required',
            'car_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'brand' => 'required',
            'manufacturing_data' => 'required|before:tomorrow'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Thông tin không được bỏ trống',
            'name.unique' => 'Thông tin đã tồn tại',
            'category_id.required' => 'Thông tin không được bỏ trống',
            'maker_id.required' => 'Thông tin không được bỏ trống',
            'classcar_id.required' => 'Thông tin không được bỏ trống',
            'car_id.required' => 'Thông tin không được bỏ trống',
            'description.required' => 'Thông tin không được bỏ trống',
            'price.required' => 'Thông tin không được bỏ trống',
            'price.min' => 'Giá không được âm',
            // 'price.max' => 'Giới hạn 9 số',
            'brand.required' => 'Thông tin không được bỏ trống',
            'manufacturing_data.required' => 'Thông tin không được bỏ trống',
            'manufacturing_data.before' => 'Kiểm tra lại ngày đã chọn'
        ];
    }
}
