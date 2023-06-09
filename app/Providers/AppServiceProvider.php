<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



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
        $categories = Category::all();
        View::share('categories', $categories);

        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $total = Cart::where('user_id', Auth::user()->id)->count();
                //Session::put('cartTotal', $total);
                $view->with('cartTotal', $total);
            }
             
        });
        
    }
}
