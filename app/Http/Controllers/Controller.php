<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUser($guard = null)
    {
        if($guard)
        {
            if(Auth::guard($guard)->check())
            {
                return Auth::guard($guard)->user();
            }
        }
        else
        {
            $roles = config('auth.guards');
            unset($roles['api']);
            unset($roles['web']);
            $guards = array_combine(range(1, count($roles)),array_keys($roles));
            foreach($guards as $k => $guard)
            {
                if(Auth::guard($guard)->check())
                {
                    return Auth::guard($guard)->user();
                }
            }
        }
        return null;
    }
}
