<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserProfiled
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
        if(config('values.USER_PROFILE_COMPLETE') &&  count(auth()->user()->details) == 0 ){
            return redirect('/start');
        }
        return $next($request);
    }
}
