<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidVendors extends FormRequest
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
            'logo'=>'required_Without:id|mimes:jpg,png,jpeg',
            'name'=>'required|string',
            'email'=>'required|email|unique:vendors,email,'.$this->id,
            'mobile'=>'required|numeric|unique:vendors,mobile,'.$this->id,
            'maincategory_id'=>'required|numeric|exists:maincategories,id',
           'address'=>'required|string|max:150',

        ];
    }
}
