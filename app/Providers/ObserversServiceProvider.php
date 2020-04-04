<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ObserversServiceProvider extends ServiceProvider
{
    private string $modelNamespace = "App\\";
    private string $observerNamespace = "Observers\\";
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
        foreach ($this->loadModels() as $model) {
            if (file_exists(base_path("app/Observers/{$model}Observer.php"))){
                $this->app->make($this->modelNamespace.$model)->observe($observer = $this->modelNamespace.$this->observerNamespace."{$model}Observer");
                info("$observer Loaded And executed");
            }
        }
    }

    private function loadModels()
    {
        return array_filter(scandir(base_path('app/')),function ($item){
            return Str::contains($item,".php") && $item !== "helpers.php";
        });
    }
}
