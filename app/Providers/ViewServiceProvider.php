<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['ventas.create'], // Lista de vistas específicas
            function ($view) {
                $productosSelected = collect(session('productosSelected', []));
                $view->with('productosSelected', $productosSelected);
            }
        );
    }
    
}
