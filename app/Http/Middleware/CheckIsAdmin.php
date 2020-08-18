<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsAdmin
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
        if(auth()->user()->role != 'admin') {
            return response()->json(['errors' => [
                'message' => 'You are not authorized to access this resource.'
            ]], 403);
        }

        return $next($request);
    }
}
