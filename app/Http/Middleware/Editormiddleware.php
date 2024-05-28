<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class Editormiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type ==3 )
            {
                return $next($request);

            }
            elseif(Auth::user()->user_type == 4 )
            {
                return $next($request);

            }
            elseif(Auth::user()->user_type == 5 )
            {
                return $next($request);

            }
            elseif(Auth::user()->user_type == 2 )
            {
                return $next($request);

            }

        
            else{
                Auth::logout();
            return redirect('/');
            }
        }

        
        else
        {
            Auth::logout();
            return redirect('/');

        }

    }
}
