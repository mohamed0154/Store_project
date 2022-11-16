<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordControll extends Controller
{
    public function reset(Request $request){
       // return $request;
         return view('auth.password.check_email');
    }

    public function make_sure(Request $request){

        if(isset($request) && !empty($request)){
            $request->validate([
                'email'=>'required|email|exists:users',
            ]);
            $user=User::where('email',$request->email)->first();
           if(isset($user) && $user != null)
           {
               $form_reset= view('auth.password.reset_password',compact('user'))->renderSections();

              return get_response(true,$form_reset['reset_password']);
           }

        }

   }
   public function change_password(Request $request){
       if(isset($request) && $request != null){
           $request->validate([
             'password'=>'required|string',
             'confirmation_password'=>'required|string|same:password',
             'id'=>'required|exists:users',
           ]);
           $user=User::find($request->id);
           if(isset($user) && $user != null){
               $user->update($request->except('id'));
               return get_response(true,"Password is changed successfully <a style='color:blue' href='/login'>Sign In</a>" );
           }else{
               return get_response(true,'the email not belogs to user');
           }

       }
   }
}
