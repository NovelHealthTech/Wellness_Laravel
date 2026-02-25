<?php

namespace App\Providers;

use App\Models\Redcliffcart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::share('siteName', 'My App');
        View::share('year', date('Y'));

    }

}
