<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\ValidLoginAdmin;
use App\Http\Requests\ValidLang;
use App\Models\Lang;
use App\Models\Subcategory;
use App\Models\Maincategory;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

class Dashboard extends Controller
{


    public function Dashboard(){

       $subcategories=Subcategory::Selection()->where('translation_lang',locale_lang())->get();
        return view('admin.dashboard.dashboard',compact('subcategories'));
    }
}
