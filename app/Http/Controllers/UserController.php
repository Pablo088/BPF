<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{   
    public function login(){
        return view('login');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->route('bus-stops.index');
    }
    public function validateLogin(){      
        return redirect()->route('bus-stops.index');
    }
    public function register(){
        return view('register');
    }
    public function storeUser(Request $request){
        $credentials = $request->validate([
            'email'=>['required'],
        ]);

        if(Auth::attempt($credentials)){
            return redirect()->back()->with(['warning' => 'Tu email ya esta registrado']);
        } else {
            $user = new User();
       
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->assignRole('User');
            
            $user->save();
    
            return redirect()->route('bus-stops.index');
        }
    }
}
