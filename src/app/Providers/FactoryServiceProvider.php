<?php

namespace App\Providers;

use App\Adapters\Factory\SmaregiApiTokenFactory;
use Illuminate\Support\ServiceProvider;
use Smaregi\SmaregiApiToken\Models\Factory\SmaregiApiTokenFactoryInterface;

class FactoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SmaregiApiTokenFactoryInterface::class, SmaregiApiTokenFactory::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
