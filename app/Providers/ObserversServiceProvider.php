<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ObserversServiceProvider extends ServiceProvider
{
    private array $models = [
        'User',
        'Product',
        'Category'
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        foreach ($this->models as $model) {
            $modelNamespace = "App\\$model";
            $modelNamespace::observe("App\\Observers\\{$model}Observer");
        }
    }
}
