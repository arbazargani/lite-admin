<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class HasAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->rule == 'admin' || Auth::user()->rule == 'root') {
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
