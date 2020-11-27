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



Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', 'LoginController@getLogin')->name('Login');
Route::get('/', 'LoginController@getLogin');


Route::post('/post-login', 'LoginController@authenticate')->name('Login.Auth');

Route::middleware(['adminRoute'])->group(function (){
    Route::get('/logout','LoginController@getLogOut')->name('Logout'); 
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('recruitment', 'RecruitmentController@index');
    Route::get('recruitment/create', 'RecruitmentController@create');
    Route::get('skills', 'SkillController@index');
    Route::get('skills/create', 'SkillController@create');





    Route::post('skills/store', 'SkillController@store');
    Route::post('recruitment/store', 'RecruitmentController@store');


    
    Route::delete('skills/destroy/{id}', 'SkillController@destroy');


    

 });
 