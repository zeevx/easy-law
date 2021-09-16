<?php

namespace App\Http\Middleware;

use Closure;

class ClientMiddleware
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
        if (!moduleStatusCheck('ClientLogin') or auth()->user()->role_id != 0){
            abort(401);
        }

       return $next($request);
    }
}
