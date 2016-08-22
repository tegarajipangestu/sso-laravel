<?php

namespace App\Http\Middleware;

use Closure;
use Saml2;
use URL;
use Auth;


class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user()) {
            return $next($request);            
        }
        return Saml2::login(URL::full());                
    }
}
