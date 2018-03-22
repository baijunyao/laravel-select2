<?php

namespace Baijunyao\LaravelSelect2\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class LaravelSelect2
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        // 获取 response 内容
        $content = $response->getContent();

        // 如果没有 body 标签直接返回
        if (false === strripos($content, '</body>')) {
            return $response;
        }

        // 如果没有用到 select2 直接返回
        if (false === strripos($content, 'js-laravel-select2')) {
            return $response;
        }
    
        // 插入 css 标签
        $select2CssPath = asset('statics/select2-4.0.4/css/select2.min.css');

        $select2Css = <<<php
<link href="$select2CssPath" rel="stylesheet" type="text/css" />
</head>
php;

        // 插入 js 标签
        $select2JsPath = asset('statics/select2-4.0.4/js/select2.min.js');
        $jqueryJsPath = asset('statics/jquery-2.2.4/jquery.min.js');

        $select2Js = <<<php
<script>
    (function(){
        window.jQuery || document.write('<script src="$jqueryJsPath"><\/script>');
    })();
</script>
<script src="$select2JsPath"></script>
<script>
    $('.js-laravel-select2').select2({
        language: 'zh-CN',
        width: '100%'
    });
</script>
</body>
php;

        $seach = [
            '</head>',
            '</body>'
        ];
        $subject = [
            $select2Css,
            $select2Js
        ];
        // p($content);die;
        $content = str_replace($seach, $subject, $content);
        // 更新内容并重置Content-Length
        $response->setContent($content);
        $response->headers->remove('Content-Length');
        return $response;
    }
}
