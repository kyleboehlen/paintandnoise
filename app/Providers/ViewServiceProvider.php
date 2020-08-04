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
        /** ABOUT */
        View::composer(
            'about', 'App\Http\Composers\AboutComposer'
        );
        
        /** ACCOUNT */
        View::composer(
            'account.categories', 'App\Http\Composers\AccountComposer'
        );
        
        View::composer(
            'account.index', 'App\Http\Composers\AccountComposer'
        );

        /** ADMIN */
        View::composer(
            'admin.faq', 'App\Http\Composers\Admin\FaqComposer'
        );

        View::composer(
            'admin.home', 'App\Http\Composers\Admin\HomeComposer'
        );

        View::composer(
            'admin.users', 'App\Http\Composers\Admin\UsersComposer'
        );

        /** FAQ */
        View::composer(
            'faq', 'App\Http\Composers\FaqComposer'
        );

        /** TOP */
        View::composer(
            'top', 'App\Http\Composers\TopComposer'
        );
    }
}
