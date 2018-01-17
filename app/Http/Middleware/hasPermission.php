<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class hasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (Auth::user() &&  Auth::user()->hasPermission($permission)==1) {
               return $next($request);
        }

       return redirect('/');

        return $next($request);
    }
}
