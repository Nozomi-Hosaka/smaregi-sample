<?php
declare(strict_types=1);

namespace App\Providers;

use App\Adapters\ReadModel\SmaregiApiTokenReadModel;
use App\Adapters\Repository\SmaregiApiTokenRepository;
use Illuminate\Support\ServiceProvider;
use Smaregi\SmaregiApiToken\Models\ReadModel\SmaregiApiTokenReadModelInterface;
use Smaregi\SmaregiApiToken\Models\Repository\SmaregiApiTokenRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SmaregiApiTokenReadModelInterface::class, SmaregiApiTokenReadModel::class);
        $this->app->bind(SmaregiApiTokenRepositoryInterface::class, SmaregiApiTokenRepository::class);
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
