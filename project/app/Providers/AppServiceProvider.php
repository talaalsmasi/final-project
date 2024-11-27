<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactMessage;
use App\Models\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */



     public function boot()
     {
         View::composer('layouts.header', function ($view) {
             $cartCount = session()->has('cart') ? count(session('cart')) : 0;
             $wishlistCount = session()->has('wishlist') ? count(session('wishlist')) : 0;

             $view->with(compact('cartCount', 'wishlistCount'));
         });
     }



}
