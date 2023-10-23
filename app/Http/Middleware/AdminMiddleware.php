<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     
     */
    public function handle($request, Closure $next) 
    {
        if(Auth::check() && Auth::user()->plan_id == 4)
        {
            return $next($request);
        }
        else
        {
            return redirect('/');
        }
    }
}
