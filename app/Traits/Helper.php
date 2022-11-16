<?php
namespace App\Traits;
use App\Models\Description;
use App\Models\Lang;
use App\Models\Maincategory;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Str;
use DB;
use Validator;
Trait Helper{

       public function setPhoto($image,$name,$path){
          $extension=$image->getClientOriginalExtension();
           $name=$name.time().'.'.$extension;
           $image->move($path,$name);
           return $name;
       }
       public function editCategory($maincategory_id){
             $data_category=Maincategory::with('translations')->find($maincategory_id);
             $langs=Lang::get();

             return view('admin.maincategories.edit',compact('data_category','langs'));

       }
       public function del_ajax($request){
        //   return $request;
            try{
                if(isset($request) && !empty($request)) {
                DB::beginTransaction();
                    $maincategory= Maincategory::find($request->id);
                    if(isset($maincategory) && $maincategory!= null){

                    if(file_exists(Maincategory::PathImage().$maincategory->image) && $maincategory->image != null &&locale_lang() == 'ar'){

                        unlink(Maincategory::PathImage().$maincategory->image);
                    }

                    $maincategory->delete();
                    DB::commit();
                    return get_response(true,'Deleted Done');
                    }
                    return get_response(false,'Not Found');
                }
            }catch(\Exception $ex){
                DB::rollback();
                return $ex;
                return get_response(false,'Not Found');
            }
      }

      public function editSubcategory($request){
           try{
               if(isset($request) && !empty($request)){
                   $subcategory=Subcategory::find($request->id);
                   if(isset($subcategory) && $subcategory != null){
                       if(!$request->has('statue'))
                       {
                           $request->merge(['statue'=>0]);
                       }
                       $up_subcategory=$request->except('description');

                       if($request->has('image'))
                       {

                           if(file_exists(Subcategory::PathImage().$subcategory->image) && $subcategory->image != null)
                           {
                               unlink(Subcategory::PathImage().$subcategory->image);
                           }
                           $image=$this->setPhoto($request->image,$request->name,Subcategory::PathImage());
                           $up_subcategory['image']=$image;
                       }
                             
                       $subcategory->description->update([
                           'description'=>$request->description,
                       ]);
                       $subcategory->update($up_subcategory);
                       return get_response(true,'Updated Done Reload Page');
                   }
                   return get_response(false,'Not Exists');
               }
           }catch(\Exception $ex){
            return get_response(false,'Error');
              // return $ex;
           }

      }

      public function valid($request){
           if($request->has('image') || $request->has('name'))
           {
               $request->validate([
                   'name'=>'required_without:image',
                   'image'=>'required_without:name|mimes:jpg,png,jpeg'
               ]);

           }
          if($request->has('new_password'))
          {
             $request->validate([
                 'password'=>'required|min:10',
                  'new_password'=>'required|min:10',
                  'confirm_password'=>'required_without:new_password|same:new_password'
              ]);

          }
          if($request->has('new_email'))
          {
             $request->validate([
                  'email'=>'required|exists:users,email|email',
                  'new_email'=>'required|email|unique:users,email'
              ]);

          }

      }

}
