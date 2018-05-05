<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use app\User;
use Closure;

class CheckRole
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
        if (Auth::user()->roleId != User::ADMIN && Auth::user()->roleId != User::SUPPER_ADMIN) {
            return response('Làm gì vậy đồng chí.', 401);
        }
        return $next($request);
    }
}
