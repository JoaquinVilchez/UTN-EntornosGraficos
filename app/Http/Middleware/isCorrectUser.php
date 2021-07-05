<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;

class isCorrectUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check()) {
            if (Auth::user()->type === 'admin') {
                return $next($request);
            } else {
                if (Auth::user()->id === intval($request->route('id_user'))) {
                    return $next($request);
                } else {
                    return redirect()->route('home');
                }
            }
        }
    }
}
