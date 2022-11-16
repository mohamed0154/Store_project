<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidLoginAdmin;
use App\Http\Requests\ValidLang;
use App\Models\Lang;
use App\Models\Admin;
use App\Models\Maincategory;
use Illuminate\Support\Facades\Auth;

class LogoutControll extends Controller
{

    public function logout(){

         $admin=Auth::guard('admin')->user();
         if(isset($admin) && $admin !=null){

           Auth::guard('admin')->logout($admin);
           return redirect(route('login'));
          }
          $user=Auth::guard('web')->user();
          Auth::guard('web')->logout($user);

          return redirect(route('login'));
    }
}

