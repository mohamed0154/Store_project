<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidSubcategory extends FormRequest
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

            'the_price'=>'required|numeric',
            'description'=>'required|string',
            'maincategory_id'=>'numeric|exists:maincategories,id',
            'image'=>'required_without:id|mimes:jpg,png,jpeg',
            'name'=>'required|string',
            'translation_lang'=>'required|string|max:6',
            'parent_id'=>'required|numeric',
            'subcategory_num'=>'required|numeric',
        ];
    }
}
