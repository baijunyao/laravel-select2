<?php

namespace Baijunyao\LaravelSelect2;

use Baijunyao\LaravelPluginManager\Contracts\PluginManager;

class Manager extends PluginManager
{
    protected $element = 'js-laravel-select2';

    protected function load()
    {
        $select2Js = <<<php
$('.js-laravel-select2').select2({
    language: 'zh-CN',
    width: '100%'
});
php;
        $this->cssFile('statics/select2-4.0.4/css/select2.min.css')
            ->jquery()
            ->jsFile('statics/select2-4.0.4/js/select2.min.js')
            ->jsContent($select2Js);
    }

}