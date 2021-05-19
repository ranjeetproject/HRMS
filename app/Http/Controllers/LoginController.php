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
    
    public function getLogin()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:1'
        ],[
            'email.required' => 'Incorrect email or password.',
            'password.required' => 'Incorrect email or password.',
            'email.email' => 'Email format is invalid',
            'password.min' => 'Incorrect email or password.',
        ]);
        $roles = config('auth.guards');
        $user =null;
        unset($roles['api']);
        unset($roles['web']);
        $guards = array_combine(range(1, count($roles)),array_keys($roles));
        foreach($guards as $k => $guard)
        {
            $credentials = ['email' => $request->get('email'),
            'password' => $request->get('password'),'department_id' => $k];
            if (Auth::guard($guard)->attempt($credentials))
            {
                return redirect()->route('dashboard');
            }
        }
        return back()->withInput($request->only('email', 'remember'))
        ->with(['error'=>'Incorrect email or password.']);
    }

    public function getLogOut()
    {
        Session::flush();
        Auth::logout();
        return redirect()->action('LoginController@getLogin');
    }
}
