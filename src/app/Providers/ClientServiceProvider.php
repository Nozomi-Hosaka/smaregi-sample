<?php

namespace App\Providers;

use App\Adapters\ApiGuzzleClient;
use Illuminate\Support\ServiceProvider;
use Nyholm\Psr7\Factory\Psr17Factory;
use Smaregi\SmaregiApiClient\Client\Client;
use Smaregi\SmaregiApiClient\Foundation\Credential;
use Smaregi\SmaregiApiClient\Foundation\PsrFactories;

class ClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function () {
            $factory = new Psr17Factory();
            $psrFactory = new PsrFactories($factory, $factory, $factory, $factory);
            return new Client(
                $psrFactory->getUriFactory()->createUri(config('smaregi.sandbox.host', '')),
                new Credential(
                    config('smaregi.sandbox.client_id'),
                    config('smaregi.sandbox.client_secret')
                ),
                new ApiGuzzleClient(),
                $psrFactory
            );
        });
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
