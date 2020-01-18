<?php

namespace App\Http\Middleware;

use Closure;

class NotInProductionEnviroment
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
        if(config('app.env') == 'production')
        {
            return redirect()->route('root');
        }

        return $next($request);
    }
}
