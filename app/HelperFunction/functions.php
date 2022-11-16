<?php
use App\Http\Controllers\User\ContactControll;


function locale_lang(){
    return app()->getLocale();
}


 function get_response($statue,$msg){
    return response()->json([
        'status'=>$statue,
        'msg'=>$msg

    ]);


}

 function shopping_cart($subcategories_cart,$subcategory){
     foreach($subcategories_cart as $subcart){
         if($subcart->where('subcategory_id',$subcategory->id)->count >= $subcategory->subcategory_num ){
                {{'Not Available';}}
         }
     }
}


function subcategories_cart_sum($subcategories_user){
    $subcats=$subcategories_user->toArray();
    return array_sum($subcats);
}


function website_translation($text){
    return locale_lang() != 'en'?__('trans.'.$text):$text;
}



function get_image($image){
    return asset($image);
}







