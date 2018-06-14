<?php

namespace Baijunyao\LaravelSelect2;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Baijunyao\LaravelSelect2\Middleware\LaravelSelect2;
use Illuminate\Support\Facades\Blade;
use Baijunyao\LaravelJquery\Jquery;

class Select2ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/resources/statics' => public_path('statics'),
        ], 'public');

        // 定义 select2 css 标签
        Blade::directive('select2css', function () {
            return select2_css();
        });

        // 定义 select2 js 标签
        Blade::directive('select2js', function () {
            return select2_js();
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
