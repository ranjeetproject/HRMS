<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class adminRouteHandler
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
        $roles = config('auth.guards');
        $check = 0;
        unset($roles['api']);
        unset($roles['web']);
        $guards = array_combine(range(1, count($roles)),array_keys($roles));
        foreach($guards as $k => $guard)
        {
            if(Auth::guard($guard)->check())
            {
                $check++;
            }
        }
        if($check==0)
        {
            if($request->ajax())
            {
                return response()->json(['success'=>false,'message'=>'Access Denied'],401);
            }
            return redirect()->action('LoginController@getLogin')->with(['error'=>'Oops ! .Something went wrong']);
        }
       
        return $next($request);
    }
}
