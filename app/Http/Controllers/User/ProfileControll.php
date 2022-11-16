<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use App\Http\Requests\ValidRegister;
use Hash;
use App\Traits\Helper;
use Illuminate\Http\Request;

class ProfileControll extends Controller
{
    use Helper;
    public function form_edit($prof_id){
     $user=User::find($prof_id);
       return view('user.edit_user_profile',compact('user'));

    }
    public function edit(Request $request,$us){

            //////////////validation//////////
                    $this->valid($request);


      try{

            $user=User::find($us);

            if(isset($user) && $user!=null){
            if($request->has('image') || $request->has('name') ){
               // return $request;
               if($request->has('image') && $request->name == null ){
                $image=$this->setPhoto($request->image,$request->name,'user/images');
               $data=$request->except('image','name');
               $data['image']=$image;

               if(file_exists(User::PathImage().$user->image) && $user->image !=null){
                    unlink(User::PathImage().$user->image);
                   }
               $user->update($data);
               return redirect(route('form_edit_user_profile',$user->id))->with('success','Updated Done');
              }
              $data=$request->all();
              $user->update($data);
               return redirect(route('form_edit_user_profile',$user->id))->with('success','Updated Done');
            }

            if($request->has('new_password') && $request->new_password != null){

                if(password_verify($request->password,$user->password)){
                    $data=$request->except('new_password','password');
                    $data['password']=$request->new_password;
                    $user->update($data);
                    return redirect(route('form_edit_user_profile',$user->id))->with('success','Updated Done');
                }
                return redirect(route('form_edit_user_profile',$user->id))->with('error','your password is not correct');

            }

             if($request->has('email') && $request->email != null){
                $data=$request->except('email','new_email');
                $data['email']=$request->new_email;
                $user->update($data);
                return redirect(route('form_edit_user_profile',$user->id))->with('success','Updated Done');
             }

             return redirect(route('form_edit_user_profile',$user->id))->with('error','enter data correctly');

            }

      }catch(\Exception $ex){
          return $ex;
        return redirect(route('form_edit_user_profile'))->with('error','There is Error');
      }


    }

    public function delete($user_id){
        try{
            $user= User::find($user_id);
            if(isset($user) && $user!=null){
                $user->delete();
                return redirect(route('login'));
            }
        }catch(\Exception $ex){
            return $ex;
        }


    }
}
