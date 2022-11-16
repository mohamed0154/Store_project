<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class branch_governorate extends Model
{
    use HasFactory;

    protected $table='branch_governorate';
    protected $fillable=['id','branch_id','governorate_id','address'];

    public $timestamp=true;
}
