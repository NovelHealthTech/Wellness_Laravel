<?php

namespace App\Providers;

use App\Models\Redcliffcart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('retailer.individualpackage', function ($view) {
            try {
                $redcliffitems = Redcliffcart::all();
            } catch (\Exception $e) {
                $redcliffitems = collect(); // prevent crash
            }

            $view->with('redcliffitems', $redcliffitems);
        });
    }
}
