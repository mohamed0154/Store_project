<?php

namespace App\Http\Middleware;

use App\Models\Maincategory;
use Closure;
use Illuminate\Http\Request;

class RedirMaincategory
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
        $maincategories=Maincategory::where('translation_lang',app()->getLocale())->get();
        if($maincategories->count() == null){
            return redirect(route('create_maincategory'));
        }
        return $next($request);
    }
}
