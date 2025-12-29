<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;

use App\Models\Redcliffcart;
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
        $redcliffitems = Redcliffcart::all();

        View::share('redcliffitems', $redcliffitems);
    }
}
