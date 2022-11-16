<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AccountControll extends Controller
{
    public function delete(Request $request){
        try{
                if(isset($request)){
                    $admin=Auth::guard('admin')->user();
                    if(isset($admin) && $admin != null){
                        $admin->delete();
                        return get_response(true,'your account is deleted reload page');
                    }
                }
           
        }catch(\Exception $ex){
            return $ex;
            return get_response(false,'Error');
        }
       
    }
}
