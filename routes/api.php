<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->namespace('Api')->name('api.v1.')->group(function () {
    Route::middleware('throttle:'.config('api.rate_limits.sign'))->group(function (){
        // 图片验证码
        Route::post('captchas', 'CaptchasController@store')->name('captchas.store');
        // 发送短信验证码
        Route::post('verificationCodes', 'VerificationCodesController@store')->name('verificationCodes.store');
        //用户注册
        Route::post('users','UsersController@store')->name('users.store');
        //第三方登录
        Route::post('socials/{type}/authorizations','AuthorizationsController@socialStore')->where('type','wechat')->name('socials.authorizations.store');
        //登录  账号密码方式
        Route::post('authorizations', 'AuthorizationsController@store')->name('api.authorizations.store');
        //刷新token
        Route::put('authorizations/current', 'AuthorizationsController@update')->name('api.authorizations.update');
        //删除token
        Route::delete('authorizations/current', 'AuthorizationsController@destroy')->name('api.authorizations.destroy');
    });


    Route::middleware('throttle:' . config('api.rate_limits.access'))->group(function (){
        // 游客可以访问的接口

        // 某个用户的详情
        Route::get('users/{user}', 'UsersController@show')->name('users.show');

        // 登录后可以访问的接口
        Route::middleware('auth:api')->group(function() {
            // 当前登录用户信息
            Route::get('user', 'UsersController@me')->name('user.show');
        });
    });
    Route::get('captchas/{captcha_key}', 'CaptchasController@show')->name('captchas.show');

});
