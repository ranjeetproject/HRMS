<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function ()
{
    Route::get('/', 'LoginController@getLogin');
    Route::get('/login', 'LoginController@getLogin');
    Route::post('/post-login', 'LoginController@postAdminLogin');
    

    Route::middleware(['adminRoute:superadmin'])->group(function ()
    {
        
        ////////////////////////////Get Route///////////////////////////////
        Route::get('/dashboard', 'LoginController@getAdminDashboard');
        Route::get('/logout', 'LoginController@getLogOut');
        
        



        ///////////////////////////Post Route////////////////////////////
        Route::post('/change-password', 'UserController@changePasswordSubmit');



        Route::resource('member', 'EmployeeController');
        Route::resource('category', 'CategoryController');

        

    });
    

   


});