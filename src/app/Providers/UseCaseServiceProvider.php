<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Smaregi\SmaregiApiToken\Query\GetSmaregiApiToken\GetSmaregiApiToken;
use Smaregi\SmaregiApiToken\Query\GetSmaregiApiToken\GetSmaregiApiTokenInterface;
use Smaregi\SmaregiApiToken\UseCase\SaveSmaregiApiToken\SaveSmaregiApiToken;
use Smaregi\SmaregiApiToken\UseCase\SaveSmaregiApiToken\SaveSmaregiApiTokenInterface;

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
        $this->app->bind(SaveSmaregiApiTokenInterface::class, SaveSmaregiApiToken::class);
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
