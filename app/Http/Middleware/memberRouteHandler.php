<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class memberRouteHandler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard='member')
    {
        if (Auth::guard($guard)->check()) {
            return redirect()->action('LoginController@getAdminDashboard');
        }

        return $next($request);
    }
}
