<?php

namespace App\Http\Middleware;

use Closure;

class LogoutUserOnDelete
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
        $user = \Auth::user();

        if(!is_null($user) && !is_null($user->deleted_at))
        {
            \Auth::logout();
        }

        return $next($request);
    }
}
