<?php

namespace App\Http\Controllers;


use App\Models\Subcategory;
use App\Models\User;
use App\Models\ShoppingCart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidLoginAdmin;
use App\Http\Requests\ValidLang;
use App\Models\Lang;
use App\Models\Branch;
use App\Models\Maincategory;

use Auth;
class HomeController extends Controller
{
    public function home(){


        $maincategories=Maincategory::with('parents')->Selection()->GetActive()->where('translation_lang',app()->getLocale())->get();

        $branches=Branch::with(['maincategories'=>function($q){
         $q->select('category','translation_lang','branch_id','id')->GetActive()->where('translation_lang',app()->getLocale());
        }])->select('id','branch')->where('translation_lang',app()->getLocale())->get();
        $subcategories=Subcategory::Selection()->Active()->where('translation_lang',app()->getLocale())->get();
        $subcategories_cart=ShoppingCart::where('user_id',Auth::id())->pluck('count')->toArray();
        return view('home.index',compact('maincategories','branches','subcategories','subcategories_cart'));
    }

}

