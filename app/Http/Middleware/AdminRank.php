<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminRank
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
        if (auth()->user()->rank_id > 5) {
           return redirect()->route('approvedform');
        }
        if (auth()->user()->rank_id == 0) {
           return redirect()->route('admintable');
        }
        return $next($request);
        
    }
}
