<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PageView;

class PageViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $pageViews = PageView::all();
            $view->with('pageViews', $pageViews);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
