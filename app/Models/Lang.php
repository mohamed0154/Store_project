<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    use HasFactory;
    protected $table='langs';
    protected $fillable=['name','statue','abbr','direction','locale'];
    public function scopedata($d){
        return $d->select('name','statue','abbr','direction','id');
    }
    public function getStatue(){
       return $this->statue==1 ? 'active' : 'not active';
    }
    public function getActive(){
        return $this->statue == 1;
    }

    public function getLActive(){
        return where('statue', 1);
    }
}
