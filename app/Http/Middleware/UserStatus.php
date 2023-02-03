<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserStatus
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
        if (auth()->user()->Status == 3 || auth()->user()->Status == 1 || auth()->user()->Status == 0) {
            return redirect()->route('signup');
        }
        return $next($request);
    }
}
