<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Flat3\Lodata\Facades\Lodata;
use App\Models\Product;
use App\Models\Review;


class LodataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if(!App::runningInConsole()){
            Lodata::discover(Product::class);
            Lodata::discover(Review::class);
        }
    }
}
