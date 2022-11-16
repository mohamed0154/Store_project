<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Over extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table='overs';
    protected $fillable=['name','email','address','mobile','image','category','the_price','description','condition','paying_off','negotiate'];

    public function scopePathImage(){
        return 'admin/images/overs/';
    }

    public function scopeSelection($q){
        return $q->select('id','name','email','address','mobile','image','category','the_price','description','condition','paying_off','negotiate');
    }
}
