<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable=['name','email','address','mobile','category','the_number','the_price'];

    public function scopeSelection($q){
        return $q->select('id','name','email','mobile','address','category','the_number','the_price');
    }
}
