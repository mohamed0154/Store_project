<?php

namespace App\Models;


use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table='reviews';
    protected $fillable=['id','subcategory_id','name','email','opinion'];

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
}
