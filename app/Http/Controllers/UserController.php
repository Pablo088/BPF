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
        if(Auth::check()){
            return redirect()->back()->with(['warning' => 'Tu sesion ya está activa']);
        } else{
            return redirect()->route('bus-stops.index');
        }
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

        Auth::login($user);

        return redirect()->route('bus-stops.index');
    }
}
