<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Address extends FormRequest
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
            'address' => 'required|max:50|min:3|unique:addresses,address,'.$this->id.',id,deleted_at,NULL',
        ];
    }

    public function messages()
    {
        return [
            'address.required' => 'Tên không được bỏ trống',
            'address.unique' => 'Tên bạn nhập đã có',
            'address.max' => 'Tên không được dài hơn 50 ký tự',
            'address.min' => 'Tên không được ngắn hơn 3 ký tự',
        ];
        
    }
}
