<?php

namespace App\Models;


use App\Models\Image;
use App\Models\Review;
use App\Models\Parentt;
use App\Models\Specification;
use App\Models\Description;
use App\Observers\SubCategoryObserv;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Subcategory extends Model
{
    use Searchable;
    use HasFactory;

    protected $table='subcategories';
    protected $fillable=['statue','id','translation_lang','image','the_price','parent_id','name','maincategory_id','subcategory_num','created_at'];


    public static function boot(){
       parent::boot();
       Subcategory::observe(SubCategoryObserv::class);
    }

    public function images(){
        return $this->hasMany(Image::class,'subcategory_id');
    }

    public function maincategory(){
        return $this->belongsTo(Maincategory::class,'maincategory_id');
    }

    public function scopeSelection($q){
        return $q->select('statue','translation_lang','id','image','the_price','parent_id','name','maincategory_id','subcategory_num','created_at');
    }
    public function scopePathImage($q){
        return 'admin/images/subcategories/';
    }

    public function getActive(){
        return $this->statue==1;
    }

    public function scopeActive($q){
        return $q->where('statue',1);
    }

    public function getStatue()
    {
        return $this->statue == 1 ? 'active' : 'not active';
    }

    public function parent(){
        return $this->belongsTo(Parentt::class,'parent_id');
    }

    public function description(){
        return $this->hasOne(Description::class,'subcategory_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class,'subcategory_id');
    }

    public function specification(){
        return $this->hasOne(Specification::class,'subcategory_id');
    }

    public function hasImages(){
        return count($this->images) > 0 ? 'Has Images' : 'Has Not Images';
    }

    public function getSpecifications(){
        if(isset($this->specification) && $this->specification != null){
            $specification= str_replace('&',':',$this->specification->specification);
            $specification= explode(':',$specification);
                foreach($specification as $counter=>$specific){
                    if($counter % 2 ==0){
                        $key_specifications[]= $specific;
                    }else{
                        $value_specifications[]=$specific;
                    }
                }
            if(count($key_specifications) == count($value_specifications)){
                for($d=0; $d < count($key_specifications); $d++){
                    $specifications[$key_specifications[$d]]=$value_specifications[$d];
                }
                    return $specifications;
            }
            return [];
           }

    }

    public function hasSpecifications(){
        return $this->specification != null ? 'Has Specifications' : 'Has Not Specifications';
    }

    public function hasReviews(){
        return count($this->reviews) > 0 ? 'Has Reviews' : 'Has Not Reviews';
    }


    public function users(){
        return $this->belongsToMany(User::class);
    }

}
