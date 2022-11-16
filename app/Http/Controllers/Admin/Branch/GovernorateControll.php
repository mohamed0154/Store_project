<?php

namespace App\Http\Controllers\Admin\Branch;

use App\Models\Branch;
use App\Models\Governorate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GovernorateControll extends Controller
{
    public function add(){
        return view('admin.branches.add_governorate');
    }

    public function store(Request $request){

       try{

            if(isset($request) && !empty($request)){
                $request->validate([
                    'name'=>'required|string|max:100',
                    'translation_lang'=>'required|max:6',
                ]);

                Governorate::create($request->all());
                return get_response(true,'Successfully added');
            }
       }catch(\Exception $ex){
        return $ex;
           return get_response(false,'Error');
       }


    }
}
