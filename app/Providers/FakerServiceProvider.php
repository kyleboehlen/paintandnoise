<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Generator as Faker;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Faker::class, function ($app){
            $faker = \Faker\Factory::create();
            $faker->addProvider(new \App\Http\Helpers\Fakers\FaqFaker($faker));
            return $faker;
        } );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
