<?php

namespace App\Providers;

use App\Models\Redcliffcart;
use App\Models\Srlcart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {

            if (auth()->check()) {

                $srlcartitems = Srlcart::where("user_id", auth()->id())->get();
                $redcliffcartitems = Redcliffcart::where("user_id", auth()->id())->get();

                $view->with([
                    'siteName' => 'My App',
                    'srlcartitems' => $srlcartitems,
                    'redcliffcartitems' => $redcliffcartitems,
                ]);

            } else {

                $view->with([
                    'siteName' => 'My App',
                  
                ]);
            }
        });
    }

}
