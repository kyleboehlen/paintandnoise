<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /** ACCOUNT */
        View::composer(
            'account.index', 'App\Http\Composers\AccountComposer'
        );

        /** ADMIN */
        View::composer(
            'admin.home', 'App\Http\Composers\Admin\HomeComposer'
        );

        View::composer(
            'admin.users', 'App\Http\Composers\Admin\UsersComposer'
        );

        /** ABOUT */
        View::composer(
            'about', 'App\Http\Composers\AboutComposer'
        );
    }
}
