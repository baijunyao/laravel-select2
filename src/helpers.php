<?php

use Baijunyao\LaravelJquery\Jquery;

if (!function_exists('select2_css')){
    /**
     * select2 css标签
     *
     * @param string $message
     */
    function select2_css()
    {
        $select2CssPath = asset('statics/select2-4.0.4/css/select2.min.css');
        $select2Css = <<<php
<link href="$select2CssPath" rel="stylesheet" type="text/css" />
php;
        return $select2Css;
    }
}

if (!function_exists('select2_js')){
    /**
     * select2 js标签
     *
     * @param string $message
     */
    function select2_js()
    {
        $select2JsPath = asset('statics/select2-4.0.4/js/select2.min.js');
        $jquery = Jquery::unique();
        $select2Js = <<<php
$jquery
<script src="$select2JsPath"></script>
php;
        return $select2Js;
    }
}