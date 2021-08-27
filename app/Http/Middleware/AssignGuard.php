<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$guard,$url='auth/login')
    {
        if(!Auth::guard($guard)->check())
        {
            return redirect($url);
        }
        Auth::shouldUse($guard);
        return $next($request);
    }
}
