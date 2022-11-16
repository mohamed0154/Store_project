<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Models\Subcategory;
use Auth;

class ShoppingControll extends Controller
{
    
    public function shopping_cart(Request $request){
        try{

            if(isset($request) && !empty($request)){
                 $subcategory=Subcategory::find($request->subcategory_id);
                 $subcategory_user=ShoppingCart::where('subcategory_id',$request->subcategory_id)->where('user_id',Auth::id())->first();
              
                 if(isset($subcategory_user) && $subcategory_user != null ){
                     if($subcategory_user->count < $subcategory->subcategory_num){
                          $subcategory_user->update([
                              'count'=>$subcategory_user->count+=1,
                          ]);
                           return response()->json([
                               'status'=>true,
                               'the_num'=>$subcategory->subcategory_num,
                               'count'=>$subcategory_user->count
                            ]);
                     }
                 }else{
                     $request->merge(['user_id'=>Auth::id(),'count'=>1]);
                     $subcategory_user= ShoppingCart::create($request->all());

                     return response()->json([
                         'status'=>true,
                         'the_num'=>$subcategory->subcategory_num,
                         'count'=>$subcategory_user->count
                       ]);
                 }
            }
        }catch(\Exception $ex){
           // return $ex;
            return get_response(false,'Error');
        }

    }

    public function delete_cart_subcategory(Request $request){
        try{
            $subcategory_user= ShoppingCart::where('subcategory_id',$request->id)->where('user_id',Auth::id())->first();
            if(isset($subcategory_user) && $subcategory_user->count() >0 ){
                
                if($subcategory_user->count == 1){
                    $subcategory_user->delete();
                    return response()->json([
                          'status'=>true,
                          'msg'=>'Deleted Done',
                          'count'=>0,
                    ]);
                    //return get_response(true,'Deleted Done');
                }

                $subcategory_user->update([
                     'count'=>$subcategory_user->count-=1
                ]);
                return response()->json([
                    'status'=>true,
                    'msg'=>'Deleted',
                    'count'=>$subcategory_user->count,
              ]);
               // return get_response(true,'Deleted');
            }

                return get_response(false,'Not Found');

        }catch(\Exception $ex){
            return $ex;
            return get_response(false,'Error');
        }

    }

    public function delete_shopping_subcategory($subcategories){
        foreach($subcategories as $subcategory){
            $subcategory->update(['subcategory_num'=>$subcategory->subcategory_num-=1]);
            ShoppingCart::where('user_id',Auth::id())->where('subcategory_id',$subcategory->id)->first()->delete();
        }
    }

}
