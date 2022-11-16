<?php

namespace App\Models;
//use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    //use AuthenticableTrait;
    use HasFactory;
    protected $table='admins';
    protected $fillable=['email','password','name','image','confirm_password'];
   public $timestamps=false;
   public function redir($user){
              $admin=$this->where('email',$user->getEmail())->first();
       if(isset($admin)){
           return $admin;
       }
       else{
          $admin= $this->create([
             'name'=>$user->getName(),
             'email'=>$user->getEmail(),
           ]);
           return $admin;
       }
   }

}
