<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;

class Redirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('admin')->check()){
            return redirect(route('dashboard'));
        }elseif(Auth::guard('web')->check()){
            return redirect(route('home'));
        }
        return $next($request);
    }
}
