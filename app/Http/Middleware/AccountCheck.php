<?php

namespace App\Http\Middleware;

use Closure;

class AccountCheck
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
        if(!Auth::guard('account')->check())
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
