<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Models\Maincategory;
use App\Models\Parentt;
use App\Models\Branch;
use App\Models\ShoppingCart;
use Auth;
use Illuminate\Http\Request;

class AllCategories extends Controller
{
    public function all_categories($maincategory_id){
        $mainncategory=Maincategory::find($maincategory_id);
        if(isset($mainncategory) && $mainncategory != null){

            $branche= $mainncategory->branch;
            $subcategories= $mainncategory->subcategories()->Active()->paginate(paginate_count);
            $maincategories=$branche->maincategories->where('translation_lang',locale_lang());
            $governorates=Governorate::where('translation_lang',locale_lang())->get();
            $subcategories_cart=ShoppingCart::where('user_id',Auth::id())->pluck('count')->toArray();
            return view('user.allCategories.all_categories',compact('subcategories_cart','mainncategory','governorates','subcategories','maincategories'));
        }
        return redirect()->back()->with('error','Categories Not Exists');


    }

    public function categories_from_parent($parient_id){
        try{
          $parent=Parentt::find($parient_id);
            if(isset($parent) && $parent->count() > 0){
                $mainncategory=Parentt::find($parient_id)->maincategory;
                $maincategories=$mainncategory->branch->maincategories;
                $categories=$parent->subcategories;
                $subcategories_cart=ShoppingCart::where('user_id',Auth::id())->pluck('count')->toArray();
                return view('user.allCategories.all_categories', compact('subcategories_cart','categories','maincategories','mainncategory'));
            }
            return redirect()->back()->with('error','Categories Not Exists');
        }catch(\Exception $ex){
            return redirect()->back();
        }
    }
}
