<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AverageCategory extends Model
{
    use HasFactory;

    protected $table='averagecategories';
    protected $fillable=['id','maincategory_id','average'];

    public function maincategory(){
        return $this->belongsTo(Maincategory::class,'maincategory_id');
    }
}
