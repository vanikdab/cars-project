<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
        Validator::extend('unique_for', function ($attribute, $value, $parameters)
        {
            list($table, $field, $id) = $parameters;

            return !DB::table($table)->where($field, '<>', $id)->where($attribute, $value)->first();
        });
    }
}
