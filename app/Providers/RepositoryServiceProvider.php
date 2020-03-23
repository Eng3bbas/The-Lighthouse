<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories;
class RepositoryServiceProvider extends ServiceProvider
{
    private array $repositories = [
        Repositories\IUserRepository::class => Repositories\UserRepository::class,
        Repositories\IProductRepository::class => Repositories\ProductRepository::class,
        Repositories\ICategoryRepository::class => Repositories\CategoryRepository::class,
        Repositories\IOrderRepository::class => Repositories\OrderRepository::class
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $abstract => $concrete) {
            $this->app->singleton($abstract,$concrete);
        }
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
