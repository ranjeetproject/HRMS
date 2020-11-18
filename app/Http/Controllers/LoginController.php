<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SiteConfiguration;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Config;
use Session;

class LoginController extends Controller
{
    
    protected $redirectTo = RouteServiceProvider::HOME;
    public function getLogin()
    {
        if(Auth::guard('superadmin')->check())
        {
            return redirect()->action('LoginController@getAdminDashboard');
        }
        else{
            return view('admin.login');
        }
    }

    public function postAdminLogin(Request $request)
    {
        
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        
        $role = config('auth.guards');
        unset($role['api']);
        unset($role['web']);
        $guards = array_combine(range(1, count($role)),array_keys($role));
        foreach($guards as $k => $guard)
        {
            
            $credentials = ['email' => $request->get('email'),
            'password' => $request->get('password'), 'user_type' => $k-1];
            
            if(Auth::guard($guard)->attempt($credentials))
            {
                return redirect()->action('LoginController@getAdminDashboard');
            }
        }
        return back()->withInput($request->only('email', 'remember'))
        ->with(['error'=>'Oops! You have entered invalid username or password']);
    }
    

    public function getAdminDashboard()
    {
        return view('admin.dashboard');
    }

    public function getLogOut(Request $request)
               {   
        Auth::guard('superadmin')->logout();
        return redirect()->action('LoginController@getLogin');
    }
    protected function guard()
    {
        dd(Auth::guard('superadmin'));
        
    }

}
