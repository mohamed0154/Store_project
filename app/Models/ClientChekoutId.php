<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientChekoutId extends Model
{
    use HasFactory;
    protected $table='checkouts_id';
    protected $fillable=['id','checkout_id'];
}
