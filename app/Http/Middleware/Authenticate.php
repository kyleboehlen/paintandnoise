<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if(!$request->expectsJson())
        {
            if($request->is('admin/*'))
            {
                return route('admin');
            }
            elseif($request->is('trending') || $request->is('top/*') || $request->is('local') || $request->is('vote'))
            {
                return route('login');
            }

            return route('root'); // Redirects to home when unauthenticated so the redirect can be handled in the home controller
        }
    }
}
