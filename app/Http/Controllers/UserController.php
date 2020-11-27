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


}
