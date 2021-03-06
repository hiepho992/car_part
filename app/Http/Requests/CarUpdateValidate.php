<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarUpdateValidate extends FormRequest
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
            'name' => 'required',
            'classcar_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Thông tin không được bỏ trống',
            'classcar_id.required' => 'Thông tin không được bỏ trống'
        ];
    }
}
