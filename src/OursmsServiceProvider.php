<?php

namespace Munafio\OurSMS;

use Illuminate\Support\ServiceProvider;
use Munafio\OurSMS\Console\InstallOurSMS;

class OursmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('oursms', function() {
            return new \Munafio\OurSMS\OurSMS;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallOurSMS::class,
            ]);
            $this->setPublishes();
        }

    }

    /**
     * Publishing the files that the user may override.
     *
     * @return void
     */
    protected function setPublishes()
    {
        // Config
        $this->publishes([
            __DIR__ . '/config/oursms.php' => config_path('oursms.php')
        ], 'oursms-config');

    }
}
