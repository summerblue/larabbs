<?php

return array(

    // 后台的 URI 入口
    'uri' => 'admin',

    // 后台专属域名，没有的话可以留空
    'domain' => '',

    // 应用名称，在页面标题和左上角站点名称处显示
    'title' => env('APP_NAME', 'Laravel'),

    // 模型配置信息文件存放目录
    'model_config_path' => config_path('administrator'),

    // 配置信息文件存放目录
    'settings_config_path' => config_path('administrator/settings'),

    /*
     * 后台菜单数组，多维数组渲染结果为多级嵌套菜单。
     *
     * 数组里的值有三种类型：
     * 1. 字符串 —— 子菜单的入口，不可访问；
     * 2. 模型配置文件 —— 访问 `model_config_path` 目录下的模型文件，如 `users` 访问的是 `users.php` 模型配置文件；
     * 3. 配置信息 —— 必须使用前缀 `settings.`，对应 `settings_config_path` 目录下的文件，如：默认设置下，
     *              `settings.site` 访问的是 `administrator/settings/site.php` 文件
     * 4. 页面文件 —— 必须使用前缀 `page.`，如：`page.pages.analytics` 对应 `administrator/pages/analytics.php`
     *               或者是 `administrator/pages/analytics.blade.php` ，两种后缀名皆可
     *
     * 示例：
     *  [
     *      'users',
     *      'E-Commerce' => ['collections', 'products', 'product_images', 'orders'],
     *      'Settings'  => ['settings.site', 'settings.ecommerce', 'settings.social'],
     *      'Analytics' => ['E-Commerce' => 'page.pages.analytics'],
     *  ]
     */
    'menu' => [
        '用户与权限' => [
            'users',
            'roles',
            'permissions',
        ],
        '内容管理' => [
            'categories',
            'topics',
            'replies',
        ],
        '站点管理' => [
            'settings.site',
        ],
    ],

    /*
     * 权限控制的回调函数。
     *
     * 此回调函数需要返回 true 或 false ，用来检测当前用户是否有权限访问后台。
     * `true` 为通过，`false` 会将页面重定向到 `login_path` 选项定义的 URL 中。
     */
    'permission' => function () {
        // 只要是能管理内容的用户，就允许访问后台
        return Auth::check() && Auth::user()->can('manage_contents');
    },

    /*
     * 使用布尔值来设定是否使用后台主页面。
     *
     * 如值为 `true`，将使用 `dashboard_view` 定义的视图文件渲染页面；
     * 如值为 `false`，将使用 `home_page` 定义的菜单条目来作为后台主页。
     */
    'use_dashboard' => false,

    // 设置后台主页视图文件，由 `use_dashboard` 选项决定
    'dashboard_view' => '',

    // 用来作为后台主页的菜单条目，由 `use_dashboard` 选项决定，菜单指的是 `menu` 选项
    'home_page' => 'topics',

    // 右上角『返回主站』按钮的链接
    'back_to_site_path' => '/',

    // 当选项 `permission` 权限检测不通过时，会重定向用户到此处设置的路径
    'login_path' => 'permission-denied',

    // 允许在登录成功后使用 Session::get('redirect') 将用户重定向到原本想要访问的后台页面
    'login_redirect_key' => 'redirect',

    // 控制模型数据列表页默认的显示条目
    'global_rows_per_page' => 20,

    // 可选的语言，如果不为空，将会在页面顶部显示『选择语言』按钮
    'locales' => [],
);
