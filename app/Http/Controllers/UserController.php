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
    public function changePasswordSubmit(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin');
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
                return ['success' => true, 'message' => "Password Change Successfully,You can login your new password"];
           
            } else {
                return ['success' => false, 'message' => 'Please enter valid old password'];
            }
        } else {
            return redirect()->action('LoginController@getLogin');
        }
    }
}
