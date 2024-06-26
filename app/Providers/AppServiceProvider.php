<?php

namespace App\Providers;

use App\Models\About;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $about = About::where('kantor', 'Pusat')->first();
            $view->with('about', $about);
        });
    }
}
