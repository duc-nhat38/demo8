<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'district_id' => 'required',
            'address_id' => 'required',
            'business_type_id' => 'required',
            'area' => 'required',
            'price' => 'required',
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'user_id.required' => 'Lỗi chưa đăng nhập',
            'district_id.required' => 'Địa chỉ không được để trống',
            'business_type_id.required' => 'Thể loại Không được để trống',
            'area.required' => 'Diện tích Không được để trống',
            'title.required' => 'Tiêu đề Không được để trống',
            // 'title.string' => 'Tiêu đề phải là kí tự',
            'description.required' => 'Miêu tả Không được để trống',
            'photo.required' =>  'Ảnh Không được để trống',
        ];

    }
}
