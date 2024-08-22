<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Spatie\Permission\Models\Role;


class sessionAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::where('email','=',$request->email )->where('password','=',$request->password)->get();
        dd($user);
        if($user !== null){
            return $next($request);
        } else if($user == null){
            return redirect()->back();
        }
    }
}
