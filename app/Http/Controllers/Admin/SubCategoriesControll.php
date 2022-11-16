<?php

namespace App\Http\Controllers\Admin;
use App\Models\Branch;
use App\Models\Description;
use App\Models\Maincategory;
use App\Models\Parentt;
use App\Models\Image;
use App\Models\ShoppingCart;
use App\Models\Specification;
use App\Traits\Helper;
use App\Models\Subcategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidSubcategory;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SubcategoriesControll extends Controller
{
    use Helper;
    public function create(){
        $branches=Branch::all();

        $parentSubCat=Parentt::select('id','type')->where('translation_lang',app()->getLocale())->get();
        $lang_maincategory=Maincategory::where('translation_lang',app()->getLocale())->first();
        $maincategories=Maincategory::Selection()->where('translation_lang',app()->getLocale())->get();

            //  if(isset($maincategories) && count($maincategories) > 0) {
                 return view('admin.subcategories.create', compact('parentSubCat', 'branches', 'maincategories', 'lang_maincategory'));
             //}
            // return redirect(route('create_parent'));
    }
    public function store(ValidSubcategory $request){

        try{

           DB::beginTransaction();
            $image= $this->setPhoto($request->image,$request->name,Subcategory::PathImage());
            $data=$request->except('image','description','_token');
            $data['image']=$image;
            if(!$request->has('statue')){
                $data['statue']=0;
            }

           $id=Subcategory::insertGetId($data);
            Description::create([
                'subcategory_id'=>$id,
                'description'=>$request->description,

            ]);
            DB::commit();
            return get_response(true,'Created Done');

        }catch(\Exception $ex){
            DB::rollBack();
           return $ex;
           return get_response(false,'Error');
        }
     }

     public function subcategories(){
          $subcategories=Subcategory::with('maincategory')->Selection()->where('translation_lang',app()->getLocale())->get();
          return view('admin.subcategories.indexes',compact('subcategories'));
     }


     public function change_statue($subcategory_id){
      try {
            $col=Subcategory::find($subcategory_id);
            if(isset($col)&& $col->count() > 0){
            $statue=$col->statue==1 ? 0 : 1;
            $col->update(['statue'=>$statue]);
            return redirect(route('all_subcategories'))->with('success',$col->name.' is '.$col->getStatue());
            }
      }catch(\Exception $ex){
            return redirect(route('all_subcategories'))->with('error','There is problem');
      }
   }

    public function delete(Request $request){
        try{
            if(isset($request->id) && $request->id!=null) {

                $subcategory=Subcategory::find($request->id);
                if(isset($subcategory) && $subcategory!=null){
                    if(file_exists(Subcategory::PathImage().$subcategory->image) && $subcategory->image != null)
                    {
                        unlink(Subcategory::PathImage().$subcategory->image);
                    }
                    if(isset($subcategory->users) && $subcategory->users->count() > 0){
                        $this->delete_cart_category($subcategory->id);
                    }
                    $subcategory->delete();
                    return get_response(true,'Deleted Done');
                }
                return get_response(false,'Not Found');
            }
            return get_response(false,'Data is empty');

        }catch(\Exception $ex){

         // return $ex;
          return get_response(false,'Error');
        }

   }

       public function delete_cart_category($subcategory_id){
        $user_subcategories=ShoppingCart::where('subcategory_id',$subcategory_id)->get();
        if(isset($user_subcategories) && $user_subcategories->count() > 0){
            foreach($user_subcategories as $subcategory){
                $subcategory->delete();
            }

        }
       }
        public function form_edit($subcategory_id){

            $subcategory_edit=Subcategory::find($subcategory_id);
            $parentSubCat=Parentt::select('id','type')->where('translation_lang',app()->getLocale())->get();
            $maincategories=Maincategory::Selection()->wherehas('parents')->where('translation_lang',app()->getLocale())->get();

            if(isset($maincategories) && count($maincategories) > 0){
                return view('admin.subcategories.create', compact('parentSubCat','subcategory_edit',  'maincategories'));
            }
        }

        public function edit(ValidSubcategory $request){
        return $this->editSubcategory($request);
        }

        public function add_images_subcategories(){
            $subcategories=Subcategory::selection()->where('translation_lang',locale_lang())->get();
            return view('admin.subcategories.add_images',compact('subcategories'));
        }


        public function store_images(Request $request){

            try{

                if(isset($request) && !empty($request)){
                    $request->validate([
                        'subcategory_id'=>'required|exists:subcategories,id',
                        'image'=>'required|mimes:jpg,png,jpeg'
                    ]);

                    if($request->has('image')){
                         $data=$request->except('image');
                         $subcategory=Subcategory::find($request->subcategory_id);
                         $image=$this->setPhoto($request->image,$subcategory->name,Subcategory::PathImage());
                         $data['image']=$image;
                         Image::create($data);
                         return get_response(true,'created_done');
                    }
                }
                return get_response(false,'There is error');
            }catch(\Exception $ex){
                return $ex;
                return get_response(false,'There is error');
            }

        }


        public function add_specifications(){
            $subcategories=Subcategory::Selection()->where('translation_lang',locale_lang())->get();
            return view('admin.subcategories.add_specifications',compact('subcategories'));
        }

        public function store_specifications(Request $request){
           try{
                if(isset($request) && !empty($request)){
                    $valid=Validator::make($request->all(),[
                        'subcategory_id'=>'numeric|exists:subcategories,id',
                        'specification'=>'required|max:1000'
                    ]);
                    if($valid->fails()){
                       $err= $valid->errors()->toArray();
                       $errors= array_values($err);
                        return get_response(false,$errors);
                    }


                    $check= stripos($request->specification,'&');

                    if($check == null){
                         $errors=['check your Specifications &'];
                        return get_response(false,$errors);
                    }


                    Specification::create($request->all());
                    return get_response(true,'Created Done');
                }
           }catch(\Exception $ex){
               return $ex;
            return get_response(false,'Error');
           }

        }
        public function images($subcategory_id){
              $subcategory_images=Subcategory::wherehas('images')->with('images')->find($subcategory_id);

               if(isset($subcategory_images) && $subcategory_images != null){
                 return view('admin.subcategories.features',compact('subcategory_images'));
               }
        }


        public function specifications($subcategory_id){
            $subcategory_specifications=Subcategory::wherehas('specification')->with('specification')->find($subcategory_id);
                 if(isset($subcategory_specifications) && $subcategory_specifications != null){
                   return view('admin.subcategories.features',compact('subcategory_specifications'));
                 }
          }


          public function reviews($subcategory_id){
              $sub_has_reviews=Subcategory::wherehas('reviews')->find($subcategory_id);
              if(isset($sub_has_reviews))
              {
                return view('admin.subcategories.features',compact('sub_has_reviews'));
              }

          }
}
