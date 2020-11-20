<?php

return [
<<<<<<< HEAD
    //http 请求超时时间（秒）
    'timeout' => 10.0,

    //默认发送配置
    'default' => [
        //网关调用策略，默认:顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        //默认可用的发送网关
        'gateways' => [
            'aliyun',
        ]
    ],
    //可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' =>'/tmp/easy-sms.log',
=======
    // HTTP 请求的超时时间（秒）
    'timeout' => 10.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'aliyun',
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        ],
        'aliyun' => [
            'access_key_id' => env('SMS_ALIYUN_ACCESS_KEY_ID'),
            'access_key_secret' => env('SMS_ALIYUN_ACCESS_KEY_SECRET'),
<<<<<<< HEAD
            'sign_name' => 'ABC商城',
            'templates' => [
                'register' => env('SMS_ALIYUN_TEMPLATE_REGISTER'),
            ]
        ]
=======
            'sign_name' => 'Larabbs',
            'templates' => [
                'register' => env('SMS_ALIYUN_TEMPLATE_REGISTER'),
            ]
        ],
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    ],
];
