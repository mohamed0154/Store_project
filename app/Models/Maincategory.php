<?php

namespace App\Models;

use App\Observers\MainCategoryObserv;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor;
use App\Models\Branch;
use App\Models\Parentt;
use App\Models\AverageCategory;
use App\Models\Subcategory;
use Laravel\Scout\Searchable;
//use App\Ocservers\MainCategoryObserv;
class Maincategory extends Model
{
    use HasFactory;
    use Searchable;

    protected $table='maincategories';
    protected $fillable=['translation_of','status','translation_lang','image','category'];

    public static function boot(){
      parent::boot();
        Maincategory::observe(MainCategoryObserv::class);
    }

    public function scopeSelection(){
         return $this->select('id','image','branch_id','status','translation_lang','translation_of','category');
    }
    public function scopeGetActive($val){
      return $val->where('status',1);
    }

    public function getStatus(){
      return $this->status==1 ? 'active':'not active';
    }
    public function translations(){
      return $this->hasMany(self::class,'translation_of');
    }
    public function average(){
        return $this->hasOne(AverageCategory::class,'maincategory_id');
    }
    public function vendors(){
      return $this->hasMany(Vendor::class,'maincategory_id');
    }
    public function subcategories(){
        return $this->hasMany(Subcategory::class,'maincategory_id');
    }

    public function parents(){
        return $this->hasMany(Parentt::class,'maincategory_id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function scopePathImage($q){
      return 'admin/images/maincategories/';
  }
}
