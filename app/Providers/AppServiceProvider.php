<?php

namespace laravel\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('view')->composer('*', function($view)
        {
            $action = app('request')->route()->getAction();
            if (isset($action['controller']) === false) {
                return false;
            }
            $controller = class_basename($action['controller']);

            list($controller, $action) = explode('@', $controller);
            $controller = str_replace('Controller', '', $controller);
            $controller = strtolower($controller);
            $view->with(compact('controller', 'action'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
