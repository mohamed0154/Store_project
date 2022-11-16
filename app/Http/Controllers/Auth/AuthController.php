<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Admin;
//use Toastr;
use App\Traits\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidRegister;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  use Helper;

  public function register(){
      return view('auth.register');
  }
    public function store(ValidRegister $request){

      try{
       $image=$this->setPhoto($request->image,$request->name,'user/images');
       $data=$request->except('image');
       $data['image']=$image;
            User::create($data);
            return redirect(url('register'))->with('success','User Created Done');
      }catch(\Exception $ex){
      return $ex;
      }
    }

    public function authenticate(Request $request){
          $request->validate([
              'email'=>'required|email',
              'password'=>'required|string',
          ]);
    // return $request;
        if(isset($request) && !empty($request)){
            $remember=$request->has('remember_me')? true : false;
            if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$remember)){

                return redirect(route('dashboard'));

            }elseif(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$remember)){

                return redirect(route('home'));
            }

            return back()->with('error','user or pass is incorrect');
        }

    }

}
