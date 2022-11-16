<?php

namespace App\Observers;

use App\Models\Maincategory;
use App\Models\Subcategory;
use App\Models\Vendor;

class MainCategoryObserv
{
    /**
     * Handle the Maincategory "created" event.
     *
     * @param  \App\Models\Maincategory  $maincategory
     * @return void
     */
    public function created(Maincategory $maincategory)
    {


    }

    /**
     * Handle the Maincategory "updated" event.
     *
     * @param  \App\Models\Maincategory  $maincategory
     * @return void
     */
    public function updated(Maincategory $maincategory)
    {
            if($maincategory->status==0) {
                $maincategory->vendors()->update(['statue' => $maincategory->status]);
            }
    }

    /**
     * Handle the Maincategory "deleted" event.
     *
     * @param  \App\Models\Maincategory  $maincategory
     * @return void
     */
    public function deleted(Maincategory $maincategory)
    {
                      ///////////////////////////
        ///////////////////Delete Sub Categories/////////
           $subcategories=$maincategory->subcategories();
           if(isset($subcategories)&& $subcategories->count() > 0){
               foreach($maincategory->subcategories as $subcategory){
                   $subcategory->description()->delete();

       ////////////////////////Images Of Categories////////////////////////
                    if(isset($subcategory->images) && $subcategory->images->count() > 0){
                        foreach($subcategory->images as $image){
                            if(file_exists(Subcategory::PathImage() . $image->image)){
                                    unlink(Subcategory::PathImage() . $image->image);
                                }
                            $image->delete();
                        }
                    }

                    if(file_exists(Subcategory::PathImage() . $subcategory->image)){
                        unlink(Subcategory::PathImage() . $subcategory->image);
                   }

       /////////////////////////////specifications of Subcategories////////////////////
                    if(isset($subcategory->specification) && $subcategory->specification->count() > 0){
                        $subcategory->specification()->delete();
                    }


               }
               $subcategories->delete();
           }
                   ////////////////////////////////////////
           ////////////////Del Parent Subcategories/////////////////////
            if(isset($maincategory->parents) && $maincategory->parents->count() > 0)
            {
              $maincategory->parents()->delete();
            }

                       ////////////////////////////
             //////////////////Delete Average////////////
           if(isset($maincategory->average) && $maincategory->average!=null){
               $maincategory->average()->delete();
           }

           /////////////////////////////////////////////////////////////////////////////////
////////////////Delete Translations && Transla/tion's Subcategories && Translation's vendors////////////
        $translations=$maincategory->translations;
        if(isset($translations) && $translations->count() > 0){

                foreach($translations as $trans) {

                       $trans->average()->delete();

                  if(isset($trans->subcategories) && $trans->subcategories->count() > 0){
                        foreach($trans->subcategories as $subcategory) {
                            $subcategory->delete();
                        }
                  }

                    if(isset($trans->parents) && $trans->parents->count() > 0){
                        foreach($trans->parents as $parent) {
                            $parent->delete();
                        }
                    }


                    foreach($trans->vendors as $vendor) {
                        if(file_exists(Vendor::PathImage() . $vendor->logo)){
                            unlink(Vendor::PathImage() . $vendor->logo);
                         }
                        $vendor->delete();
                    }

            }

            $maincategory->translations()->delete();
        }

                    ///////////////////////////////////
  //////////////////////////////Delete Vendors///////////////////////////
        if(isset($maincategory->vendors) && $maincategory->vendors->count() > 0 )
        {
            foreach($maincategory->vendors as $vendor) {
                if(file_exists(Vendor::PathImage() . $vendor->logo)){
                    unlink(Vendor::PathImage() . $vendor->logo);
                 }

            }
            $maincategory->vendors()->delete();
        }



    }

    /**
     * Handle the Maincategory "restored" event.
     *
     * @param  \App\Models\Maincategory  $maincategory
     * @return void
     */
    public function restored(Maincategory $maincategory)
    {
        //
    }

    /**
     * Handle the Maincategory "force deleted" event.
     *
     * @param  \App\Models\Maincategory  $maincategory
     * @return void
     */
    public function forceDeleted(Maincategory $maincategory)
    {
        //
    }
}
