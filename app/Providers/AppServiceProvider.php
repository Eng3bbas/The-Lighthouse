<?php

namespace App\Providers;

use App\Order;
use Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(ObserversServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('active',function ($link){
            if (empty($link))
                abort(500,'Your link is empty , Please inter valid one');
            return sprintf("<?php if(is_item_active($link)): ?>");
        });
        Blade::directive('endactive',function() {
            return "<?php endif; ?>";
        });
        Blade::directive('admin',fn() => "<?php if(auth()->user()->is_admin): ?>");
        Blade::directive('endadmin',fn() => "<?php endif; ?>");
        Blade::directive('update_delete_order', function ($order_datetime) {
            return "<?php if(now()->diffInDays($order_datetime) <= 1 ): ?>";
        });
        Blade::directive('endupdate_delete_order',function()
        {
            return "<?php endif; ?>";
        });
    }
}
