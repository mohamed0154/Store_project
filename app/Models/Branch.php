<?php

namespace App\Models;

use App\Models\Maincategory;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;

class Branch extends Model
{
    use HasFactory;
    protected $table='branches';
    protected $fillable=['branch','id','translation_lang','translation_of'];

    public function maincategories(){
      return $this->hasMany(Maincategory::class,'branch_id');
    }

    public function subcategories(){
        return $this->hasManyThrough(Subcategory::class,\App\Models\Maincategory::class,'branch_id','maincategory_id');
    }

    public function governorates(){
        return $this->belongsToMany(Governorate::class);
    }
}
