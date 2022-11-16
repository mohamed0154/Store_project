<?php

namespace App\Models;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;
    protected $table='specifications';
    protected $fillable=['id','subcategory_id','specification'];

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }

    public function getSpecifications(){
      return str_replace('&','-',$this->specification);
    }


}
