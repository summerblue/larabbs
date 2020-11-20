<?php

return [
    /*
<<<<<<< HEAD
     * 接口频率现在
     */
    'rate_limits' => [
        //访问频率限制，次数/分钟
        'access' => env('RATE_LIMITS','60,1'),
        //登录相关，次数/分钟
        'sign' => env('SIGN_LIMITS','10,1'),
    ]
=======
     * 接口频率限制
     */
    'rate_limits' => [
        // 访问频率限制，次数/分钟
        'access' =>  env('RATE_LIMITS', '60,1'),
        // 登录相关，次数/分钟
        'sign' =>  env('SIGN_RATE_LIMITS', '10,1'),
    ],
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
];
