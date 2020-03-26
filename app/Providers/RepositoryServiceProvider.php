<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories;
class RepositoryServiceProvider extends ServiceProvider
{
    public array $singletons = [
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
