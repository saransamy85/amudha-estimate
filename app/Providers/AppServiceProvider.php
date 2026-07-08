<?php

namespace App\Providers;

use App\Models\customers;
use App\Models\estimate;
use App\Models\leads;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrapFive();
        View::composer('*', function ($view) {
            $view->with('onlineUsers',
                User::where('Status', 'Online')->get());

            $view->with('escount', estimate::count());

            $view->with('cuscount', customers::count());

            $view->with('lc', leads::count());
        });
    }
}
