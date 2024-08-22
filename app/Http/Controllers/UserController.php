<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{   
    public function login(){
        return view('login');
    }
    public function beginSession(Request $request){

    }
    public function register(){
        return view('register');
    }
    public function storeUser(Request $request){
        $user = new User();
       

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->assignRole('User');
        
        $user->save();

        return redirect()->route('bus-stops.index');
    }
}
