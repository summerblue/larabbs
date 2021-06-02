<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // 全局中间件
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,

        // 修正代理服务器后的服务器参数
        \App\Http\Middleware\TrustProxies::class,

        // 解决 cors 跨域问题
        \Fruitcake\Cors\HandleCors::class,

        // 检测应用是否进入『维护模式』
        // 见：https://learnku.com/docs/laravel/{{doc_version}}/configuration#maintenance-mode
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,

        // 检测表单请求的数据是否过大
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

        // 对所有提交的请求数据进行 PHP 函数 `trim()` 处理
        \App\Http\Middleware\TrimStrings::class,

        // 将提交请求参数中空子串转换为 null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    // 设定中间件组
    protected $middlewareGroups = [

        // Web 中间件组，应用于 routes/web.php 路由文件，
        // 在 RouteServiceProvider 中设定
        'web' => [
            // Cookie 加密解密
            \App\Http\Middleware\EncryptCookies::class,

            // 将 Cookie 添加到响应中
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,

            // 开启会话
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,

            // 将系统的错误数据注入到视图变量 $errors 中
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            // 检验 CSRF ，防止跨站请求伪造的安全威胁
            // 见：https://learnku.com/docs/laravel/{{doc_version}}/csrf
            \App\Http\Middleware\VerifyCsrfToken::class,

            // 处理路由绑定
            // 见：https://learnku.com/docs/laravel/{{doc_version}}/routing#route-model-binding
            \Illuminate\Routing\Middleware\SubstituteBindings::class,

            // 强制用户邮箱认证
            \App\Http\Middleware\EnsureEmailIsVerified::class,

            // 记录用户最后活跃时间
            \App\Http\Middleware\RecordLastActivedTime::class,
        ],

        // API 中间件组，应用于 routes/api.php 路由文件，
        // 在 RouteServiceProvider 中设定
        'api' => [
            // 使用别名来调用中间件
            // 请见：https://learnku.com/docs/laravel/{{doc_version}}/middleware#为路由分配中间件
            \App\Http\Middleware\AcceptHeader::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    // 中间件别名设置，允许你使用别名调用中间件，例如上面的 api 中间件组调用
    protected $routeMiddleware = [
        // 只有登录用户才能访问，我们在控制器的构造方法中大量使用
        'auth' => \App\Http\Middleware\Authenticate::class,

        // HTTP Basic Auth 认证
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,

        // 缓存标头
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,

        // 用户授权功能
        'can' => \Illuminate\Auth\Middleware\Authorize::class,

        // 只有游客才能访问，在 register 和 login 请求中使用，只有未登录用户才能访问这些页面
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        // 密码确认，你可以在做一些安全级别较高的修改时使用，例如说支付前进行密码确认
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,

        // 签名认证，在找回密码章节里我们讲过
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,

        // 访问节流，类似于 『1 分钟只能请求 10 次』的需求，一般在 API 中使用
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

        // Laravel 自带的强制用户邮箱认证的中间件，为了更加贴近我们的逻辑，已被重写
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
