<?php

namespace App\Observers;

use App\Models\ShoppingCart;
use App\Models\Subcategory;

class SubCategoryObserv
{
    /**
     * Handle the SubCategory "created" event.
     *
     * @param  \App\Models\Subcategory  $subCategory
     * @return void
     */
    public function created(Subcategory $subCategory)
    {


    }

    /**
     * Handle the SubCategory "updated" event.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return void
     */
    public function updated(Subcategory $subCategory)
    {
        //
    }

    /**
     * Handle the SubCategory "deleted" event.
     *
     * @param  \App\Models\Subcategory  $subCategory
     * @return void
     */
    public function deleted(Subcategory $subCategory)
    {
        if(isset($subCategory->description) && $subCategory->description!=null) {
            $subCategory->description()->delete();
        }
        if(isset($subCategory->images) && $subCategory->images->count() > 0){

            foreach($subCategory->images as $image){
                if(file_exists(Subcategory::PathImage() . $image->image)){
                    unlink(Subcategory::PathImage() . $image->image);
                }
            }
            $subCategory->images()->delete();
        }


        if(isset($subCategory->specification) && $subCategory->specification != null){
            $subCategory->specification()->delete();
        }

        if(isset($subCategory->reviews) && $subCategory->reviews->count() > 0){
            $subCategory->reviews()->delete();
        }


    }

    /**
     * Handle the SubCategory "restored" event.
     *
     * @param  \App\Models\Subcategory  $subCategory
     * @return void
     */
    public function restored(Subcategory $subCategory)
    {
        //
    }

    /**
     * Handle the SubCategory "force deleted" event.
     *
     * @param  \App\Models\Subcategory  $subCategory
     * @return void
     */
    public function forceDeleted(Subcategory $subCategory)
    {
        //
    }
}
