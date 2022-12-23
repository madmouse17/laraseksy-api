<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepo\AuthInterface;
use App\Repositories\AuthRepo\AuthRepository;
use App\Repositories\JadwalRepo\JadwalInterface;
use App\Repositories\JadwalRepo\JadwalRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthInterface::class,AuthRepository::class);
        $this->app->bind(JadwalInterface::class,JadwalRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
