<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\ShoppingCart;
use Auth;
use Illuminate\Http\Request;

class DescriptionCategory extends Controller
{
    public function description_category($subcategory_id){
        $subcategory=Subcategory::find($subcategory_id);
        $subcategories_cart=ShoppingCart::where('user_id',Auth::id())->pluck('count')->toArray();
           if(isset($subcategory)  && !empty($subcategory)) {
             return view('description_category.category', compact('subcategories_cart','subcategory'));
           }
    }
}
