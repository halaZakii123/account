<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Paginator::useBootstrap();
    //     Schema::defaultStringLength(191);
    //     if(Schema::hasTable('sets')){
    //         $sets = \App\Models\Set::count();
    //         if($sets==0)
    //             \App\Models\Sete::create([
    //                 'key'=>'cash_id',
    //                 'value'=>'171'
    //             ]);
    //         $settings = \App\Models\Setting::first();
    //         View::share('settings', $settings);
    //     }
    // }
    }
}
