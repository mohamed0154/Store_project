<?php

//use App\Http\Controllers\store\admin\HomeController;
use App\Http\Controllers\Admin\ComplaintsOfCategories;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\MainCategories\MainCategoriesControll;
use App\Http\Controllers\Admin\ParentSubCategory;
use App\Http\Controllers\Admin\Branch\BranchControll;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\requests\GetClientControll;
use App\Http\Controllers\Admin\requests\OrdersAndOvers;
use App\Http\Controllers\Admin\SubcategoriesControll;
use App\Http\Controllers\Admin\Vendors\VendorControll;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\Branch\GovernorateControll;
use App\Http\Controllers\Auth\LogoutControll;
use App\Http\Controllers\Admin\Langs\LangControll;
use App\Http\Controllers\Admin\CategoryControl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounts\AccountControll;
use App\Models\Admin;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

$paginate_count=define('paginate_count',10);



 Route::prefix( LaravelLocalization::setLocale())->group(function(){
     Route::middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {


                              ////////////////                 /////////////////
/////////////////////////////////////////////// Login /////////////////////////////////////

         Route::get('login',function(){
             return view('auth.login');
         })->name('login')->middleware('Redir');
         Route::POST('authenticate',[AuthController::class,'authenticate'])->name('authenticate');
   });
});
                    /////////////////////////////////////////
////////////////////////////////////////Inter Favce///////////////////////////
            Route::get('/',function(){
                return view('the_interface');
            });

                             ////////////////                 /////////////////
/////////////////////////////////////////////// logout Of admin/////////////////////////////////////


Route::get('/logout',[LogoutControll::class,'logout'])->name('logout');


Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function(){


Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function(){

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Dashboard Of admin/////////////////////////////////////


    Route::get('dashboard_admin',[Dashboard::class,'Dashboard'])->name('dashboard');

                            ////////////////                 /////////////////
/////////////////////////////////////////////// Profile Of admin/////////////////////////////////////


    Route::get('form_edit_profile/{prof_id}',[ProfileController::class,'form_edit'])->name('form_edit_profile');
    Route::POST('edit_prof/{prof_id}',[ProfileController::class,'edit'])->name('edit_profile');

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Lang Of admin/////////////////////////////////////


    Route::get('add_lang',[LangControll::class,'create'])->name('create_Lang');
    Route::POST('store_lang',[LangControll::class,'store'])->name('store_lang');
    Route::get('available_langs',[LangControll::class,'available_langs'])->name('available_langs');

    Route::POST('del_lang',[LangControll::class,'delete'])->name('delete_lang');
    Route::get('form_edit_lang/{lang_id}',[LangControll::class,'form_edit'])->name('form_edit_lang');
    Route::POST('edit_lang',[LangControll::class,'edit'])->name('edit_lang');
    Route::get('change_statue/{lang_id}',[LangControll::class,'change_statue'])->name('change_statue_lang');

                                   ////////////////                 /////////////////
/////////////////////////////////////////////// Branches Of Main Categories/////////////////////////////////////

Route::get('all_branches',[BranchControll::class,'branches'])->name('all_branches');
Route::POST('/store_branch',[BranchControll::class,'store'])->name('store_branch');
Route::get('/create_branch',[BranchControll::class,'create'])->name('create_branch');
Route::get('/form_branch_allocation',[BranchControll::class,'form_allocation'])->name('form_branch_allocation');
Route::POST('/Branch_allocation',[BranchControll::class,'allocation'])->name('branch_allocation');
Route::get('form_edit_branch/{maincategory_id}',[BranchControll::class,'form_edit'])->name('form_edit_branch');
Route::POST('edit_branch/{branch_id}',[BranchControll::class,'edit'])->name('edit_branch');
Route::POST('delete_branch',[BranchControll::class,'delete'])->name('delete_branch');



                                ////////////////                         /////////////////
/////////////////////////////////////////////// Main Categories Of admin/////////////////////////////////////

          Route::get('maincategoriess',[MainCategoriesControll::class,'maincategories'])->name('all_maincategories');
          Route::POST('/store_maincat',[MainCategoriesControll::class,'store'])->name('store_maincategory');
          Route::get('/create_maincat',[MainCategoriesControll::class,'create'])->name('create_maincategory');
        //  Route::POST('/store_categories',[MainCategoriesControll::class,'store_categories'])->name('store_categories');
          Route::get('form_edit_maincat/{maincategory_id}',[MainCategoriesControll::class,'form_edit'])->name('form_edit_maincategory');
          Route::POST('edit_maincat/{maincategory_id}',[MainCategoriesControll::class,'edit'])->name('edit_maincategory');
          Route::POST('delete_maincat',[MainCategoriesControll::class,'delete'])->name('delete_maincategory');
          Route::get('change_statue_maincat/{maincategory_id}',[MainCategoriesControll::class,'change_statue'])->name('change_statue_maincategory');


                                    ////////////////                 /////////////////
///////////////////////////////////////////////Parent Sub Categories /////////////////////////////////////

    Route::get('maincategories',[ParentSubCategory::class,'subcategories'])->name('parent_subcategories');
    Route::POST('/store_parent',[ParentSubCategory::class,'store'])->name('store_parent');
    Route::get('/create_parent',[ParentSubCategory::class,'create'])->name('create_parent')->middleware('RedirMainCat');
     // Route::POST('/images_categories',[MainCategoriesControll::class,'store_categories'])->name('images_category');
    Route::get('form_edit_parent/{category_id}',[ParentSubCategory::class,'form_edit'])->name('form_edit_parent');
    Route::POST('edit_maincategory/{category_id}',[ParentSubCategory::class,'edit'])->name('edit_parent');
    Route::get('delete_parent',[ParentSubCategory::class,'delete'])->name('delete_parent');
    Route::get('change_statue/{category_id}',[ParentSubCategory::class,'change_statue'])->name('change_statue_parent');

                               ////////////////                 /////////////////
/////////////////////////////////////////////// Sub Categories /////////////////////////////////////

    Route::get('all_subcategories',[SubcategoriesControll::class,'subcategories'])->name('all_subcategories')->middleware('st_subcategories');
    Route::POST('/store_subcategory',[SubcategoriesControll::class,'store'])->name('store_subcategory');
    Route::get('/create_subcategory',[SubcategoriesControll::class,'create'])->name('create_subcategory')->middleware('RedirMainCat');
    Route::get('/add_images_subcategories',[SubcategoriesControll::class,'add_images_subcategories'])->name('add_images_subcategory')->middleware('st_subcategories');
    Route::POST('/store_images_subcategory',[SubcategoriesControll::class,'store_images'])->name('store_images_subcategory');
    Route::get('images/{subcategory_id}',[SubcategoriesControll::class,'images'])->name('images');
    Route::get('add_specifications',[SubcategoriesControll::class,'add_specifications'])->name('add_specifications')->middleware('st_subcategories');;
    Route::POST('store_specifications',[SubcategoriesControll::class,'store_specifications'])->name('store_specifications');
    Route::get('specifications/{subcategory_id}',[SubcategoriesControll::class,'specifications'])->name('specifications');
    Route::get('form_edit_subcategories/{category_id}',[SubcategoriesControll::class,'form_edit'])->name('form_edit_subcategory');
    Route::POST('edit_subcategory',[SubcategoriesControll::class,'edit'])->name('edit_subcategory');
    Route::POST('delete_subcategory',[SubcategoriesControll::class,'delete'])->name('delete_subcategory');
    Route::get('change_statue_subcat/{subcategory_id}',[SubcategoriesControll::class,'change_statue'])->name('change_statue_subcategory');
    Route::get('reviews/{subcategory_id}',[SubcategoriesControll::class,'reviews'])->name('reviews');

                               ////////////////                 /////////////////
/////////////////////////////////////////////// admin Of Vendors/////////////////////////////////////

          Route::get('/all_vendors',[VendorControll::class,'vendors'])->name('all_vendors');
          Route::get('/create',[VendorControll::class,'create'])->name('create_vendor')->middleware('RedirMainCat');
          Route::POST('/store_vendor',[VendorControll::class,'store'])->name('store_vendor');
         // Route::get('/vendors',[VendorControll::class,'Vendors'])->name('store_vendor');
          Route::POST('/delete_vendor',[VendorControll::class,'delete'])->name('delete_vendor');
          Route::get('form_edit_vendor/{vendor_id}',[VendorControll::class,'form_edit'])->name('form_edit_vendor');
          Route::POST('edit_vendor',[VendorControll::class,'edit'])->name('edit_vendor');
          Route::POST('change_statue',[VendorControll::class,'change_statue'])->name('change_statue_vendor');

                            /////////////////////////////////////////////////
///////////////////////////////////////////////////Buy Category//////////////////////////////////////////////////

    Route::get('/overs',[OrdersAndOvers::class,'overs'])->name('overs');
    Route::POST('/delete_overs',[OrdersAndOvers::class,'delete_over'])->name('delete_overs');

                                /////////////////////////////////////////////////
///////////////////////////////////////////////////Sell Category//////////////////////////////////////////////////

    Route::get('/orders',[OrdersAndOvers::class,'orders'])->name('orders');
    Route::POST('/del_order',[OrdersAndOvers::class,'delete_order'])->name('delete_orders');


                            /////////////////////////////////////////////////
///////////////////////////////////////////////////Branches//////////////////////////////////////////////////

    Route::get('/add_governorate',[GovernorateControll::class,'add'])->name('add_governorate');
    Route::POST('/store_governorate',[GovernorateControll::class,'store'])->name('store_governorate');


});
});

                ///////////////////////////////////////////////////
///////////////////////////Delete Account User And Admin////////////////////////////
Route::POST('store',[AccountControll::class,'delete'])->name('delete_account');




