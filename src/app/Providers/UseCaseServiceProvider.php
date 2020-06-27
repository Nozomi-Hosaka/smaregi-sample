<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Smaregi\SmaregiApiToken\Query\GetSmaregiApiToken\GetSmaregiApiToken;
use Smaregi\SmaregiApiToken\Query\GetSmaregiApiToken\GetSmaregiApiTokenInterface;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GetSmaregiApiTokenInterface::class, GetSmaregiApiToken::class);
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
