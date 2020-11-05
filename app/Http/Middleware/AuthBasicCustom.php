<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Closure;
use Illuminate\Http\Request;

class AuthBasicCustom extends AuthenticateWithBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
//    public function handle(Request $request, Closure $next)
//    {
//        return $next($request);
//    }
    public function handle($request, Closure $next, $guard = null, $field = null)
    {
        $this->auth->guard($guard)->basic($field ?: 'username');

        return $next($request);
    }
}
