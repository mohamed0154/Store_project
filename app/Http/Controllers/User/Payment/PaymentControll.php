<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactValid;
use App\Models\ClientChekoutId;
use App\Models\Subcategory;
use App\Models\ShoppingCart;
use Auth;
use Illuminate\Http\Request;

class PaymentControll extends Controller
{


    public function checkout(Request $request)
    {

      // $subcategory=Subcategory::find($subcategory_id);
        $url = env('HYPERPAY_URL') . "v1/checkouts";
        $data = "entityId=" . env('HYPERPAY_ENTITY_ID') .
            "&amount=" . $request->total_price .
            "&currency=EUR" .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer '.env('HAYPERPAY_AUTH_KEY')));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('HAYPERPAY_PRODUCTION'));// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $responseData= json_decode($responseData,true);
        $view_payment=view('user.paying_off.form_payment')->with(['responseData' => $responseData])
        ->renderSections();

        return response()->json([
           'status' => true,
           'content' => $view_payment['elect_payment'],
        ]);
    }

    public function make_order(){

        if (request('id') && request('resourcePath')){
             $statuePayment = $this->paymentStatue( request('resourcePath'));
             if(isset($statuePayment['id'])){
                ClientChekoutId::create([
                    'checkout_id'=>$statuePayment['id'],
                ]);
                $this->delete_shopping_subcategory();
                return redirect(route('home'))->with('success','تمت العمليه بنجاح');
             }
            return redirect(route('make_order'))->with('error','فشلت عمليه الدفع');
        }

    }

    public function paymentStatue($resourcepath){

        $url = env('HYPERPAY_URL').$resourcepath;
        $url .= "?entityId=" . env('HYPERPAY_ENTITY_ID');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer '.env('HAYPERPAY_AUTH_KEY')));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,  env('HAYPERPAY_PRODUCTION'));// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData,true);
    }


    public function delete_shopping_subcategory(){
         $subcategories_user=Auth::user()->subcategories;
        foreach($subcategories_user as $subcategory){
            $subcategory->update(['subcategory_num'=>$subcategory->subcategory_num-=1]);
            ShoppingCart::where('user_id',Auth::id())->where('subcategory_id',$subcategory->id)->first()->delete();
        }
    }


}
