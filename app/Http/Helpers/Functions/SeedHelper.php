<?php

namespace App\Http\Helpers\Functions;

use Artisan;

class SeedHelper
{
    // Formatted to look good in the console output of db:seed
    public static function printFailures($failures = 0)
    {
        if($failures > 0)
        {
            echo "\e[31mFailures:\e[0m see error log for details ($failures failed)\n";
        }
    }

    // For seeding a specific class in migrations
    public static function seedClass($class)
    {
        Artisan::call('db:seed', ['--class' => $class]);
    }
}