<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Searchable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name',
        'email',
        'password',
        'confirmation_password',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'confirmation_password',
        'remember_token',
    ];


    public function subcategories(){
        return $this->belongsToMany(Subcategory::class);
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function login_redirect($user){
        $us=$this->where('email',$user->getEmail())->first();
        if(isset($us) && $us != null){
            return $us;
        }
      $us= $this->create([
            'email'=>$user->getEmail(),
             'name'=>$user->getName(),
        ]);
        return $us;
    }
    public function setpasswordAttribute($val){
        return $this->attributes['password']=bcrypt($val);
    }

    public function setCONFIRMATIONPASSWORDAttribute($val){
        return $this->attributes['confirmation_password']=bcrypt($val);
    }

    public function scopePathImage($q){
        return 'user/images/';
    }
}