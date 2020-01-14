<?php

namespace App\Http\Middleware;

use Closure;

class LogoutAdminOnDelete
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
        $admin = \Auth::guard('admin')->user();

        if(!is_null($admin) && !is_null($admin->deleted_at))
        {
            \Auth::guard()->logout();
        }

        return $next($request);
    }
}
