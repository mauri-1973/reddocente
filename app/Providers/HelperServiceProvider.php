<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $allHelpersFiles = glob(app_path('Helpers') . '/*.php');
        foreach($allHelpersFiles as $key => $helperfile)
        {
            require_once $helperfile;
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    /*public function boot()
    {
        //
    }*/
}
