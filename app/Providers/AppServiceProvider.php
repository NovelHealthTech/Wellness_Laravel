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



        $srlcartitems = Srlcart::all();
        $redcliffcartitems = Redcliffcart::all();

        View::share([
            'siteName' => 'My App',
            'srlcartitems' => $srlcartitems,
            'redcliffcartitems' => $redcliffcartitems,
        ]);


    }

}
