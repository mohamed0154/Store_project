<?php

namespace App\Http\Controllers\Admin\Branch;

use App\Models\Governorate;
use App\Models\Branch;
use App\Models\Lang;
use App\Models\branch_governorate;
use App\Http\Requests\ValidBranch;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class BranchControll extends Controller
{
    public function create(){
        $langs=Lang::data()->where('statue',1)->get();
        return view('admin.branches.create',compact('langs'));
    }


    public function store(ValidBranch $request){
        try{
            DB::beginTransaction();
            if(isset($request)  && !empty($request)){
                $req=collect($request->branches);
                $branch_ar=$req->filter(function($q){
                     return $q['translation_lang']=='ar';
                });

              if(isset($branch_ar[0])){
                 $id=Branch::insertGetId($branch_ar[0]);
              }else{$id=0;}


              $branch_other=$req->filter(function($q){
                return $q['translation_lang']!='ar';
              });
              if(isset($branch_other) && $branch_other->count() > 0){
                  foreach($branch_other as $branch){
                     $branch['translation_of']=$id;
                        Branch::create($branch);
                  }
              }
            DB::commit();
                return get_response(true,'Added Successfully');
            }

        }catch(\Exception $ex){
            DB::rollback();
           // return $ex;
            return get_response(false,'Error');
        }
    }

    public function form_allocation(){
        $branches=Branch::select('id','branch')->where('translation_lang',locale_lang())->get();
        $governorates=Governorate::select('id','name')->where('translation_lang',locale_lang())->get();

        if(isset($branches) && $branches->count() > 0){
            return view('admin.branches.branch_allocation',compact('governorates','branches'));
        }
        return redirect(route('create_branch'));
    }

    public function allocation(Request $request){
        try{
            if(isset($request) && !empty($request)){
                DB::beginTransaction();
                $request->validate([
                    'governorate_id'=>'numeric|exists:governorates,id',
                    'branch_id'=>"numeric|exists:branches,id",
                    'address'=>"required|string"
                ]);

                  $branch=Branch::find($request->branch_id);
                  $branch->governorates()->attach($request->governorate_id);
                  $br=branch_governorate::where('governorate_id',$request->governorate_id)->first();
                  $br->update($request->except('governorate_id','branch_id'));
                  DB::commit();
                return get_response(true,'Add Successfuly');
            }
        }catch(\Exception $ex){
            DB::rollback();
            return get_response(false,'Error');
        }

    }


    public function branches(){
        $branches=Branch::with('governorates')->select('id','branch','translation_lang')->get();

         return view('admin.branches.all_branches',compact('branches'));

        return redirect(route('form_branch_allocation'));
    }
}
