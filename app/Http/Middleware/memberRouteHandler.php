<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
    public function handle($request, Closure $next)
    {
        if(!Auth::guard('hr')->check())
        {
            if($request->ajax())
            {
                return response()->json(['success'=>false,'message'=>'Access Denied'],401);
            }
            $notification = array(
                'message' => 'Access denied',
                'alert-type' => 'error'
            );
            return redirect()->route('dashboard')->with($notification);
        }
        return $next($request);
    }
}
