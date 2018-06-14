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
            $select2CssPath = asset('statics/select2-4.0.4/css/select2.min.css');
            $select2Css = <<<php
<link href="$select2CssPath" rel="stylesheet" type="text/css" />
php;
            return $select2Css;
        });

        // 定义 select2 js 标签
        Blade::directive('select2js', function () {
            $select2JsPath = asset('statics/select2-4.0.4/js/select2.min.js');
            $jquery = Jquery::unique();
            $select2Js = <<<php
$jquery
<script src="$select2JsPath"></script>
php;
            return $select2Js;
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
