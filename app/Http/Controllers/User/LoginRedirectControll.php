<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginRedirectControll extends Controller
{
    public function login_redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function login_redirect_callback($provider,User $us)
    {
        $user = Socialite::driver($provider)->user();
            if($user->getEmail() != null){
                $user=$us->login_redirect($user);
                Auth::guard('web')->login($user);
                return redirect(route('home'));
            }
    }
}
