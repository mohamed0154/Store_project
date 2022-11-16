<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Http\Requests\ReviewValid;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewControll extends Controller
{
    public function review(ReviewValid $request){

      try{
          if(isset($request) && !empty($request)){
            Review::create($request->all());
            return get_response(true,'Your opinion is sent');
          }
      }catch(\Exception $ex){
        return $ex; 
        return get_response(false,'There is error');
        
      }
   
    }
}
