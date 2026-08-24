<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ArticuloRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\UserRepository;
use App\Repositories\Contracts\ArticuloRepositoryInterface;
use App\Repositories\Contracts\CategoriaRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ArticuloRepositoryInterface::class,
            ArticuloRepository::class
        );
        $this->app->bind(
            CategoriaRepositoryInterface::class,
            CategoriaRepository::class
        );
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
