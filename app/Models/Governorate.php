<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;
    protected $table='governorates';
    protected $fillable=['id','name','translation_lang'];

    public function branches(){
        return $this->belongsToMany(Branch::class);
    }
}
