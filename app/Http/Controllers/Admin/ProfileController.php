<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidRegister;
use App\Models\Admin;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use Helper;
    public function form_edit($profile_id){
        $admin=Admin::find($profile_id);
        if(isset($admin) && !empty($admin)) {
            return view('admin.editprofile', compact('admin'));
        }
  }

    public function edit(ValidRegister $request,$profile_id){
 try{
     if(isset($request) && !empty($request)){
        $admin=Admin::find($profile_id);

         if($request->password==null){
             $data=$request->except('_token','password','confirmation_password');
         }else{
             $data=$request->except('_token');
         }

         if($request->has('image')){
             $image=$this->setPhoto($request->image,$request->name,'admin/profile');
             $data['image']=$image;
         }
          if(file_exists('admin/images/'.$admin->image) && $admin->image!=null){
              unlink('admin/images/'.$admin->image);
          }
         // return $data;
         $admin->update($data);
         return redirect(route('form_edit_profile',$admin->id))->with('success','Updated Done');
     }
 }catch(\Exception $ex){
    // return $ex;
     return redirect(route('form_edit_profile',$admin->id))->with('error','there is proplem');
 }

    }
    public function delete($profile_id)
    {
        try {
            $admin = Admin::find($profile_id);
            if (isset($admin) && $admin != null) {
                $admin->delete();
                return redirect(route('login'));
            }
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    }
