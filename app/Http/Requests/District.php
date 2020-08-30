<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class District extends FormRequest
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
            'district' => 'required|min:3|max:50',
            'address_id' => 'required',
            'district' => Rule::unique('districts')->where('district', $this->district)
            ->where('address_id', $this->address_id)
            ->where('deleted_at', Null)
        ];
    }

    public function messages()
    {
        return [
            'district.required' => 'Tên không được bỏ trống',
            'district.unique' => 'Tên bạn nhập đã có',
            'district.max' => 'Tên không được dài hơn 50 ký tự',
            'district.min' => 'Tên không được ngắn hơn 3 ký tự',
            'address_id.required' => 'Tên không được bỏ trống',
        ];
    }
}
