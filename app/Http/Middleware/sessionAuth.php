<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class sessionAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            return redirect()->back()->with(['warning' => 'Tu sesion ya está activa']);
        } else{
            $users = User::where('email',$request->email)->get();
        
            foreach($users as $user){
                if(Hash::check($request->password, $user->password) && $user->email == $request->email){
                    return $next($request);
                } else{
                    return redirect()->back()->with(['error' => 'Su correo o contraseña es incorrecta']);
                }
            }  
        }          
    }
}
