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
  
////////////////////////////////////// Get ////////////////////////////////////////////////////////////////

    Route::get('/logout','LoginController@getLogOut')->name('Logout'); 
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('recruitment', 'RecruitmentController@index');
    Route::get('recruitment/create', 'RecruitmentController@create');
    Route::get('recruitment/show/{id}', 'RecruitmentController@show');
    Route::get('recruitment/download/{id}', 'RecruitmentController@downloadfile');
    Route::get('recruitment/edit/{id}', 'RecruitmentController@edit');

    Route::get('recruitment/interview-scheduling/{id}', 'RecruitmentController@interviewScheduling');
    Route::get('recruitment/interview-scheduling-edit/{id}', 'InterviewScheduleController@interviewSchedulingEdit');
    
    Route::get('recruitment/interview-feedback/{id}', 'RecruitmentController@interviewFeedback');
    Route::get('recruitment/interview-feedback-edit/{id}', 'InterviewFeedbackController@interviewFeedbackEdit');

    Route::get('final-round', 'FinalRoundController@index');
    Route::get('final-round-interview-scheduling/{id}', 'FinalRoundController@finalRoundInterviewScheduling');
    Route::get('final-round-interview-scheduling-edit/{id}', 'FinalRoundController@finalRoundInterviewSchedulingEdit');


    Route::get('final-round-interview-feedback/{id}', 'FinalRoundController@finalRoundInterviewFeedback');
    Route::get('final-round-interview-feedback-edit/{id}', 'FinalRoundController@finalRoundInterviewFeedbackEdit');

    Route::get('offer-list', 'OfferedController@index');

    Route::get('offer-employee-details/{id}', 'EmployeeDetailsController@offerEmployeeDetails');
    Route::get('current-employee-list', 'EmployeeDetailsController@currentEmployeeList');
    Route::get('current-employee-details/{id}', 'EmployeeDetailsController@employeeDetails');


    Route::get('skills', 'SkillController@index');
    Route::get('skills/create', 'SkillController@create');
    Route::get('skills/edit/{id}', 'SkillController@edit');


/////////////////////////////////////// Post //////////////////////////////////////////////////////////////



    Route::post('skills/store', 'SkillController@store');
    Route::post('skills/update/{id}', 'SkillController@update');
    Route::post('recruitment/store', 'RecruitmentController@store');
    Route::post('recruitment/update/{id}', 'RecruitmentController@update');
    Route::post('interview-scheduling/store', 'InterviewScheduleController@store');
    Route::post('interview-scheduling/update/{id}', 'InterviewScheduleController@update');
    Route::post('interview-feedback/store', 'InterviewFeedbackController@store');
    Route::post('interview-feedback/update/{id}', 'InterviewFeedbackController@update');


    Route::post('final-round-interview-scheduling/store', 'FinalRoundController@store');
    Route::post('final-round-interview-scheduling/update/{id}', 'FinalRoundController@update');

    Route::post('final-round-interview-feedback/store', 'FinalRoundController@finalRoundFeedbackStore');
    Route::post('final-round-interview-feedback/update/{id}', 'FinalRoundController@finalRoundFeedbackUpdate');

    Route::post('offer-employee-detail/store', 'EmployeeDetailsController@storeOfferEmployee');


    Route::delete('offer/delete/{id}', 'OfferedController@destroy');

    Route::delete('final-round-interview/delete/{id}', 'FinalRoundController@finalRoundInterviewDestroy');



    
    Route::delete('skills/destroy/{id}', 'SkillController@destroy');
    Route::delete('recruitment/destroy/{id}', 'RecruitmentController@destroy');

////////////////////////////////////////////// Resource ////////////////////////////////////////////
   
    

 });
 