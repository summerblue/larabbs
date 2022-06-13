<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enabled grant types
    |--------------------------------------------------------------------------
    |
    | This array of user provider class indexed by grant type will be enabled
    | when application is started.
    |
    */

    'grants' => [
        // 'acme' => 'App\Passport\AcmeUserProvider',
        'wechat-social' => 'App\Passport\WechatUserProvider',
    ],

];
