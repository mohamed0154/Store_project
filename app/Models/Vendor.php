<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maincategory;
use Illuminate\Notifications\Notifiable;
class Vendor extends Model
{
    use HasFactory, Notifiable;

    protected $table='vendors';
    protected $fillable=['name','address','email','logo','maincategory_id','statue','mobile'];

    public function scopeSelection($q){
        return $q->select('id','name','email','address','statue','logo','maincategory_id','mobile');
    }
    public function maincategory(){
        return $this->belongsTo(Maincategory::class,'maincategory_id');
    }

    public function getStatue(){
        return $this->statue==1?'active':'not active';
    }
    public function getActive(){
        return $this->statue==1;
    }

    public function scopePathImage($q){
        return 'admin/images/vendors/';
    }
}
