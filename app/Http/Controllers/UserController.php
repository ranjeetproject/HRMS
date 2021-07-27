<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;

class UserController extends Controller
{
   public function index()
   {
        return view('user_details.index');
   }


   public function create()
   {
    return view('user_details.create');
   }
   public function changePasswordForm(){

        return view('change_password');
   }
   public function changePasswordSubmit(Request $request)
   {
        if(Auth::guard('superadmin')->check()) {
            $user = Auth::guard('superadmin');
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);
            $oldPass = $request->get('old_password');
            $checkOldPassword = User::where('id', $user->id())->first();
            if (password_verify($oldPass, $checkOldPassword->password)) {
                $checkOldPassword->password = Hash::make($request->get('new_password'));
                $checkOldPassword->save();
                $notification = array(
                    'message' => 'Password Change Successfully,You can login your new password',
                    'alert-type' => 'success'
                );
                return redirect()->action('UserController@changePasswordForm')->with($notification);
               // return ['success' => true, 'message' => "Password Change Successfully,You can login your new password"];
                
            } else {
                $notification = array(
                    'message' => 'Please enter valid old password',
                    'alert-type' => 'error'
                );
                return redirect()->action('UserController@changePasswordForm')->with($notification);
                //return ['error' => false, 'message' => 'Please enter valid old password'];
            }
        }elseif(Auth::guard('hr')->check()){
            $user = Auth::guard('hr');
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);
            $oldPass = $request->get('old_password');
            $checkOldPassword = User::where('id', $user->id())->first();
            if (password_verify($oldPass, $checkOldPassword->password)) {
                $checkOldPassword->password = Hash::make($request->get('new_password'));
                $checkOldPassword->save();
                $notification = array(
                    'message' => 'Password Change Successfully,You can login your new password',
                    'alert-type' => 'success'
                );
                return redirect()->action('UserController@changePasswordForm')->with($notification);
            } else {
                $notification = array(
                    'message' => 'Please enter valid old password',
                    'alert-type' => 'error'
                );
                return redirect()->action('UserController@changePasswordForm')->with($notification);
               // return ['success' => false, 'message' => 'Please enter valid old password'];
            }
        } else {
            return redirect()->action('LoginController@getLogin');
        }
   }

   public function forgetPasswordForm()
   {
       return view('forgot_password');
   }

    public function forgetPasswordSendLink(Request $request)
    {
        $this->validate($request, [
            'forget_email' => 'required|email',
        ]);
        $user = User::where('email', $request->forget_email)->first();
        if ($user) {
            $rand_val = date('YMDHIS') . rand(11111, 99999);
            $token = md5($rand_val);
            $user->remember_token = $token;
            $user->save();
            Mail::send('emails.forgetPasswordEmail', ['user' => $user], function ($m) use ($user) {
                $m->from(Config::get('app.email_send'));
                $m->to($user->email)->subject('Forget Password Reset');
            });
            return redirect()->action('UserController@forgetPasswordForm')->with('success', 'We have e-mailed your password reset link!');
        } else {
            return redirect()->back()->with('error', 'This email address does not exists in our system');
        }
    }

    public function resetPasswordForm(Request $request)
    {
        $validator = Validator::make(
            [
                'token' => ($request->token) ? $request->token : null,
                'email' => ($request->email) ? $request->email : null
            ],
            [
                'token' => 'required',
                'email' => 'required|email'
            ]);

        if ($validator->fails()) {
            return view('reset_password_email_form', ['token' => null, 'errors_form' => 'Invalid Link.Please try again']);
        } else {
            $user = User::where([
                ['email', $request->email],
                ['remember_token', $request->token],
                ['deleted_at', null],
            ])->first();

            if ($user) {
                return view('reset_password_email_form', ['token' => $user->remember_token, 'errors_form' => null]);
            } else {
                return view('reset_password_email_form', ['token' => null, 'errors_form' => 'Invalid Credentials']);
            }
        }
    }

    public function resetPasswordForFrontend(Request $request)
    {
        if (!$request->token) {

            return redirect()->back()->with('error', 'Invalid Credentials.');
        }
        $request->validate([
            'new_password_reset' => 'required|min:8',
            'confirm_password_reset' => 'required|same:new_password_reset',
        ],
            [
                'new_password_reset.min' => 'New Password should have :min characters.',
                'new_password_reset.required' => 'New Password is required.',
                'confirm_password_reset.required' => 'Confirm Password is required.',
                'confirm_password_reset.same' => 'Confirm Password should be same as New password.'
            ]);

        $user = User::where('remember_token',$request->token)->first();
        if ($user) {
            $user->password = Hash::make($request->get('new_password_reset'));
            $user->remember_token = null;
            $user->save();
            return redirect()->action('LoginController@getLogin')->with('success', 'Password Change Successfully,You can login your new password.');
        } else {
            return redirect()->back()->with('error', 'Oops! something went wrong.Please try again.');
        }

    }








}
