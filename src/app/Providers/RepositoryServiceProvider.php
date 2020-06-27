<?php
declare(strict_types=1);

namespace App\Providers;

use App\ReadModel\SmaregiApiTokenReadModel;
use Illuminate\Support\ServiceProvider;
use Smaregi\SmaregiApiToken\Models\ReadModel\SmaregiApiTokenReadModelInterface;

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
