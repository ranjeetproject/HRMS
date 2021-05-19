<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use App\Repositories\UserPermissionnRepository;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view)
        {
            $data=[];
            $data['loginUser'] = null;
            $roles = config('auth.guards');
            unset($roles['api']);
            unset($roles['web']);
            $guards = array_combine(range(1, count($roles)),array_keys($roles));
            foreach($guards as $k => $guard)
            {
                if(Auth::guard($guard)->check())
                {
                    $data['loginUser'] = Auth::guard($guard)->user();
                }
            }
            $permissionCheck = new UserPermissionnRepository();
            $user_permissions = $permissionCheck->checkPermission($data['loginUser']);
            if($user_permissions){
                foreach($user_permissions as $user_permission){
                    $data['checkModulePermission'] = $user_permission;
                }
            }
            $view->with($data);
        });

        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
