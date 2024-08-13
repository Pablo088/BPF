<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{   
    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }
}
