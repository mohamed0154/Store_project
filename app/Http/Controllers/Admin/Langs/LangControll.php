<?php

namespace App\Http\Controllers\Admin\Langs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidLoginAdmin;
use App\Http\Requests\ValidLang;
use App\Models\Lang;
use App\Models\Maincategory;
use Auth;
class LangControll extends Controller
{


    public function create(){

        return view('admin.langs.add_lang');
    }
    public function store(ValidLang $request){
         

        try{
            if(isset($request) && !empty($request)) {
                
                Lang::create($request->all());
                return get_response(true,'created done');
            }
         
        }catch(\Exception $ex){
            return get_response(false,'There is  error');
        }
    }
    public function available_langs(){
        $langs= Lang::Data()->paginate(paginate_count);
        return view('admin.langs.available_langs',compact('langs',));
    }

       public function delete(Request $request){
        if(isset($request) && !empty($request)) {
            $data = Lang::where('id', $request->id)->first();
            if (isset($data) && $data != null) {
                $data->delete();
                return get_response(true,'Deleted Done');
            }
            return get_response(false,'Deleted fails');
        }

    }


    public function form_edit($lang_id){
        $data_lang=Lang::data()->find($lang_id);

        return view('admin.langs.add_lang',compact('data_lang'));
    }
    

    public function edit(ValidLang $request){
   
       try{
           if(isset($request) && !empty($request)) {
               $data_lang = Lang::find($request->id);
               if (isset($data_lang) && $data_lang != null) {

                   $data_lang->update($request->except('_token'));
                   return get_response(true,'Updated Done');
               }
               return get_response(false,'Not Found');
           }

       }catch(\Exception $ex){
           return $ex;
           return get_response(false,'There Is Error');
       }

    }

        public function change_statue($lang_id){
                $lang= Lang::find($lang_id);
                if(isset($lang) && $lang !=null){
                   $statue=$lang->statue==1 ? 0 : 1 ;
                    $lang->update(['statue'=>$statue]);
                    return redirect(route('available_langs'))->with('success','Lang '.$lang->name.' is '. $lang->getStatue());
                }
            return redirect(route('avalibale_langs'))->with('error','Not Found');
        }
}

