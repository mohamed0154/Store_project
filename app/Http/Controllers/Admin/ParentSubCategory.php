<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maincategory;
use App\Models\Parentt;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ParentSubCategory extends Controller
{
    public function create(){
        $maincategories=Maincategory::select('id','category')->where('translation_lang',app()->getLocale())->get();
        $subcategories=Subcategory::select('id','name')->get();

        return view('admin.subcategories.parent_subcategories',compact('maincategories','subcategories'));
    }


    public function store(Request $request){
        try{
            $valid=Validator::make($request->all(),[
                'maincategory_id'=>'required|numeric|exists:maincategories,id',
                'type'=>'required|string',
                'translation_lang'=>'required|max:8'
            ]);
            if($valid->fails()){
                return get_response(false,$valid->errors());
                   
            }
            if(isset($request)) {
                Parentt::create($request->all());
                return get_response(true,'Created Done');
                  
            }
        }catch(\Exception $ex){
            //return $ex;
            return get_response(false,'Error');
        }
    }

}
