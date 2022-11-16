<?php

namespace App\Http\Controllers\Admin\requests;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactValid;
use App\Models\Over;
use App\Models\Notify;
use App\Models\NotifyOfbuy;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersAndOvers extends Controller
{
    public function overs(){

     $overs= Over::Selection()->paginate(paginate_count);

         $notify=Notify::GetNotifyOver();
         if(isset($notify) && $notify != null){
             $notify->update([
                 'counter'=>0,
             ]);
         }
         return view('admin.requests.overs',compact('overs'));

    }

    public function delete_over(Request $request){
        try{

            if(isset($request) && !empty($request)){
                $over=Over::find($request->id);
                if(isset($over) && $over != null){

                    $over->delete();
                    return response()->json([
                        'statue'=>true,
                        'msg'=>'Trashed Done Reload Page'
                    ]);
                }
                return response()->json([
                    'statue'=>false,
                    'msg'=>'Not Exists'
                ]);

            }
        }catch(\Exception $ex){
           // return $ex;
            return response()->json([
                'statue'=>false,
                'msg'=>'There Is Error '
            ]);
        }

    }

    public function orders(){
        $orders= Order::Selection()->paginate(paginate_count);
        $notify=Notify::GetNotifyOrder();
        if(isset($notify) && $notify != null){
            $notify->update(['counter'=>0]);
        }
        return view('admin.requests.orders',compact('orders'));

    }

    public function delete_order(Request $request){
        try{
            if(isset($request) && !empty($request)){
                $order=Order::find($request->id);
                if(isset($order) && $order != null){
                    $order->delete();
                    return response()->json([
                        'statue'=>true,
                        'msg'=>'Deleted Done'
                    ]);
                }
                return response()->json([
                    'statue'=>false,
                    'msg'=>'Not Exists'
                ]);

            }
        }catch(\Exception $ex){
            // return $ex;
            return response()->json([
                'statue'=>false,
                'msg'=>'There Is Error '
            ]);
        }
    }



}
