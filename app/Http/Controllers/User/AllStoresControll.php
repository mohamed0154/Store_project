<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Maincategory;
use App\Models\Subcategory;
use App\Models\Vendor;
use App\Models\ShoppingCart;
use Auth;
use Illuminate\Http\Request;

class AllStoresControll extends Controller
{
    public function stores(){
       $maincategories=Maincategory::Selection()->where('translation_lang',app()->getLocale())->get();
       $subcategories_cart=ShoppingCart::where('user_id',Auth::id())->pluck('count')->toArray();
       $vendors=Vendor::Selection()->get();
       return view('user.all_vendors',compact('vendors','maincategories','subcategories_cart'));
    }
}
