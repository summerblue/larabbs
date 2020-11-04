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
        //分类列表
        Route::get('categories','CategoriesController@show')->name('categories.show');
        // 话题列表，详情
        Route::resource('topics', 'TopicsController')->only(['index','show']);
        // 某个用户的话题列表
        Route::get('users/{user}/topics', 'TopicsController@userIndex')->name('users.topics.index');
        // 话题回复列表
        Route::get('topics/{topic}/replies', 'RepliesController@index')
            ->name('topics.replies.index');
        // 某个用户的回复列表
        Route::get('users/{user}/replies', 'RepliesController@userIndex')
            ->name('users.replies.index');
        // 登录后可以访问的接口
        Route::middleware('auth:api')->group(function() {
            // 上传图片
            Route::post('images', 'ImagesController@store')->name('images.store');
            // 当前登录用户信息
            Route::get('user', 'UsersController@me')->name('user.show');
            // 编辑登录用户信息
            Route::patch('user', 'UsersController@update')->name('user.update');
            //发布话题
            Route::resource('topics','TopicsController')->only(['store','update','destroy']);
            //发表回复
            Route::post('topics/{topic}/replies','RepliesController@store')->name('topics.replies.store');
            //删除回复
            Route::delete('topics/{topic}/replies/{reply}','RepliesController@destroy')
                ->name('topics.replies.destroy');
            // 通知列表
            Route::get('notifications', 'NotificationsController@index')
                ->name('notifications.index');
            // 通知统计
            Route::get('notifications/stats', 'NotificationsController@stats')
                ->name('notifications.stats');
            // 标记消息通知为已读
            Route::patch('user/read/notifications', 'NotificationsController@read')
                ->name('user.notifications.read');
            //当前登录用户权限
            Route::get('user/permissions','PermissionsController@index')->name('user.permissions.index');
        });
    });
    //查看激活码图片
    Route::get('captchas/{captcha_key}', 'CaptchasController@show')->name('captchas.show');

});
