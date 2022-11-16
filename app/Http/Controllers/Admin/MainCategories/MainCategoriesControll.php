<?php

namespace App\Http\Controllers\Admin\MainCategories;
use App\Http\Requests\ValidMaincategory;
use App\Models\Admin;
use App\Models\AverageCategory;
use App\Models\Lang;
use App\Models\Maincategory;
use App\Http\Controllers\Controller;
use App\Models\MainCategoryType;
use App\Models\Parentt;
use App\Models\Subcategory;
use App\Models\Branch;
use Illuminate\Http\Request;
//use App\Http\Requests\CategoryValid;
use App\Traits\Helper;
use Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainCategoriesControll extends Controller
{
    use Helper;


    public function maincategories(){

        $maincategories=Maincategory::Selection()->where('translation_lang',app()->getLocale())->paginate(paginate_count);

        return view('admin.maincategories.MainCategories',compact('maincategories'));
    }
    public function create(){

        $branches=Branch::select('branch','id')->where('translation_lang',app()->getLocale())->get();
        $langs=Lang::data()->where('statue',1)->get();
        if(isset($branches) && $branches->count() > 0){
            return view('admin.maincategories.create_maincategory',compact('langs','branches'));
        }
        return redirect(route('create_branch'));

    }
    public function form_edit($category_id){

        return $this->editCategory($category_id);
    }

    public function edit(ValidMaincategory $request,$maincategory_id){

        try {
             $maincategory = Maincategory::find($maincategory_id);
            if (isset($request) && !empty($request) && isset($maincategory) && $maincategory != null) {

            $up_maincategory = $request->category[0];
            if ($request->has('image')) {
                $up_maincategory['image'] = $this->setPhoto($request->image, $up_maincategory['category'], Maincategory::PathImage());

                  $this->update_images($up_maincategory['image'],$maincategory);

                if (file_exists(Maincategory::PathImage() . $maincategory->image) && $maincategory->image != null) {
                    unlink(Maincategory::PathImage() . $maincategory->image);
                }
            }else {
                $up_maincategory['image'] = $maincategory->image;
            }


            if (!isset($up_maincategory['status'])) {
                $up_maincategory['status'] = 0;
            }


                              ////////////////////////////////////
                 ////////////////////update average for all categories//////////////////
                    if(isset($maincategory->average) && !empty($maincategory->average)) {

                        $this->update_averages($request->average,$maincategory);

                    }

                     $maincategory->update($up_maincategory);

              return redirect(route('form_edit_maincategory',$maincategory->id))->with('success', 'Updated Done');
        }
            return redirect(route('form_edit_maincategory',$maincategory->id))->with('error','There is proplem');
        }catch(\Exception $ex){
            return $ex;
            return redirect(route('form_edit_maincategory',$maincategory->id))->with('error','There is proplem');
        }
    }



    public function store(ValidMaincategory $r){

        try{

            if(isset($r) && !empty($r)) {
                DB::beginTransaction();

                $image = $this->setPhoto($r->image, $r->category[0]['category'], Maincategory::PathImage());
                $data = collect($r->category);
                $data_ar = $data->filter(function ($val, $key) {
                    return $val['translation_lang'] == 'ar';
                });
                if (isset($data_ar[0])) {
                    $data_ar = $data_ar[0];
                    if (!isset($data_ar['status'])) {
                        $data_ar['status'] = 0;
                    }
                    $data_ar['image'] = $image;
                    $data_ar['branch_id'] = $r->branch_id;

                    $id = Maincategory::insertGetId($data_ar);
                    AverageCategory::create([
                        'maincategory_id' => $id,
                        'average' => $r->average
                    ]);
                } else {
                    $id = 0;
                }
                $data_other = $data->filter(function ($val) {
                    return $val['translation_lang'] !== 'ar';
                });

                foreach ($data_other as $data_cat) {
                    if (!isset($data_cat['status'])) {
                        $data_cat['status'] = 0;
                    }
                    $data_cat['image'] = $image;
                    $data_cat['branch_id'] = $r->branch_id;
                    $data_cat['translation_of'] = $id;
                    $idd = Maincategory::insertGetId($data_cat);
                    AverageCategory::create([
                        'maincategory_id' => $idd,
                        'average' => $r->average
                    ]);
                }
                DB::commit();
                return get_response(true,'created Done');
            }

        }catch(\Exception $ex){
            DB::rollBack();
            return $ex;
           return get_response(false,'Error');

        }

     }
     public function delete(Request $request){

         return $this->del_ajax($request);
     }
    public function change_statue($maincategory_id){
        $maincat=Maincategory::find($maincategory_id);

        // return $data_category->action;
        if(isset($maincat) && $maincat->count() >0)
        {
            try{
                $statue= $maincat->status==1 ? 0 :1;

                $maincat->update(['status'=>$statue]);

                return redirect(route('all_maincategories'))->with('success','The '. $maincat->category.' category '.'is '.$maincat->getStatus());
            }catch(\exception $ex){
                return $ex;
                return redirect(route('all_maincategories'))->with('error','There is proplem');
            }

        }
    }


    public function update_averages($average,$maincategory){

            $maincategory->average()->update(['average'=>$average]);
            if(isset($maincategory->translations) && $maincategory->translations->count() > 0)
            {
                foreach($maincategory->translations  as $maincat){
                    $maincat->average()->update([
                        'average'=>$average,
                    ]);
               }
           }

    }
    public function update_images($image,$maincategory) {
        $maincategories=$maincategory->translations;
        if(isset($maincategories) && $maincategories->count() > 0) {
            foreach ($maincategories as $maincat) {
                $maincat->update(['image' => $image]);
            }
        }
    }

}
