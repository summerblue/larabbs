<?php
return [
    /*
     *接口频率限制
     */
    'rate_limits' => [
        // 访问限制
        'access' => env('LIMITS', '60,1'),
        // 登录访问限制
        'sign' => env('SIGN_LIMITS', '10,1'),
    ],
    'auth' => [
        'jwt' => 'Dingo\Api\Auth\Provider\JWT',
    ],
];