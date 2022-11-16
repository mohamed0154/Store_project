<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidRegister extends FormRequest
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
             'image'=>'required_without:id|mimes:jpg,png,jpeg',
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email,'.$this->id,
            'password'=>'required_without:id|max:12',
            'confirmation_password'=>'required_without:id|same:password|max:12'
        ];
    }
}
