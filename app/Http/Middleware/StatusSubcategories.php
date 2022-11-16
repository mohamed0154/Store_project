<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Subcategory;
class StatusSubcategories
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
        $subcategories=Subcategory::Selection()->get();
        if(isset($subcategories) && $subcategories->count() > 0 ){
            return $next($request);
        }
        return redirect(route('create_subcategory'));
    }
}
