<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use \App\User;

class IsRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       
            if (Auth::user()->roleId != User::SUPPER_ADMIN) {
                return response('Làm gì vậy đồng chí.', 401);
            }
            return $next($request);
    }
}
