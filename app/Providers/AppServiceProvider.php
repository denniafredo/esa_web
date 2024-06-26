<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Sosmed;
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
            $sosmed = Sosmed::all();
            $view->with('about', $about);
            $view->with('sosmed', $sosmed);
        });
    }
}
