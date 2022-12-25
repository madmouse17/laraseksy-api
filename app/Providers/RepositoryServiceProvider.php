<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepo\AuthInterface;
use App\Repositories\AuthRepo\AuthRepository;
use App\Repositories\JadwalRepo\JadwalInterface;
use App\Repositories\JadwalRepo\JadwalRepository;
use App\Repositories\PengumumanRepo\PengumumanInterface;
use App\Repositories\PengumumanRepo\PengumumanRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthInterface::class, AuthRepository::class);
        $this->app->bind(JadwalInterface::class, JadwalRepository::class);
        $this->app->bind(PengumumanInterface::class, PengumumanRepository::class);
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
