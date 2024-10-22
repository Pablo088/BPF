<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SoloColectivero
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user() !== null){
            if($request->user()->hasRole('Colectivero')){
                return $next($request);
            } else{
                return abort(403);
            }
          } else{
            return abort(403);
          }
    }
}
