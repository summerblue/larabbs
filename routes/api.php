<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\LinksController;
use App\Http\Controllers\Api\ImagesController;
use App\Http\Controllers\Api\TopicsController;
use App\Http\Controllers\Api\RepliesController;
use App\Http\Controllers\Api\CaptchasController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\PermissionsController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\AuthorizationsController;
use App\Http\Controllers\Api\VerificationCodesController;

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

Route::prefix('v1')
    ->name('api.v1.')
    ->group(function () {

        Route::middleware('throttle:' . config('api.rate_limits.sign'))
            ->group(function () {
                // 图片验证码
                Route::post('captchas', [CaptchasController::class, 'store'])
                    ->name('captchas.store');
                // 短信验证码
                Route::post('verificationCodes', [VerificationCodesController::class, 'store'])
                    ->name('verificationCodes.store');

                // 用户注册
                Route::post('users', [UsersController::class, 'store'])
                    ->name('users.store');

                 // 第三方登录
                Route::post('socials/{social_type}/authorizations', [AuthorizationsController::class, 'socialStore'])
                    ->where('social_type', 'wechat')
                    ->name('socials.authorizations.store');

                // 登录
                Route::post('authorizations', [AuthorizationsController::class, 'store'])
                    ->name('authorizations.store');
                // 小程序登录
                Route::post('weapp/authorizations', [AuthorizationsController::class, 'weappStore'])
                    ->name('weapp.authorizations.store');
                // 小程序注册
                Route::post('weapp/users', [UsersController::class, 'weappStore'])
                    ->name('weapp.users.store');

                // 刷新token
                Route::put('authorizations/current', [AuthorizationsController::class, 'update'])
                    ->name('authorizations.update');
                // 删除token
                Route::delete('authorizations/current', [AuthorizationsController::class, 'destroy'])
                    ->name('authorizations.destroy');
            });

        Route::middleware('throttle:' . config('api.rate_limits.access'))
            ->group(function () {
                // 游客可以访问的接口

                // 分类列表
                Route::apiResource('categories', CategoriesController::class)
                    ->only('index');

                // 某个用户发布的话题
                Route::get('users/{user}/topics', [TopicsController::class, 'userIndex'])
                    ->name('users.topics.index');

                // 话题列表，详情
                Route::apiResource('topics', TopicsController::class)->only([
                    'index', 'show'
                ]);

                 // 话题回复列表
                Route::apiResource('topics.replies', RepliesController::class)->only([
                    'index',
                ]);

                // 某个用户的回复列表
                Route::get('users/{user}/replies', [RepliesController::class, 'userIndex'])
                    ->name('users.replies.index');

                // 资源推荐
                Route::apiResource('links', LinksController::class)->only([
                    'index'
                ]);

                // 活跃用户
                Route::get('actived/users', [UsersController::class, 'activedIndex'])
                    ->name('actived.users.index');

                // 某个用户的详情
                Route::get('users/{user}', [UsersController::class, 'show'])
                    ->name('users.show');

                // 登录后可以访问的接口
                Route::middleware('auth:api')->group(function() {
                    // 当前登录用户信息
                    Route::get('user', [UsersController::class, 'me'])
                        ->name('user.show');

                    // 编辑登录用户信息
                    Route::patch('user', [UsersController::class, 'update'])
                        ->name('user.update');
                    // 编辑登录用户信息
                    Route::put('user', [UsersController::class, 'update'])
                        ->name('user.update');

                    // 上传图片
                    Route::post('images', [ImagesController::class, 'store'])
                        ->name('images.store');

                    // 发布, 修改，删除话题
                    Route::apiResource('topics', TopicsController::class)->only([
                        'store', 'update', 'destroy'
                    ]);

                    // 发布, 删除回复
                    Route::apiResource('topics.replies', RepliesController::class)->only([
                        'store', 'destroy'
                    ]);

                    // 通知列表
                    Route::apiResource('notifications', NotificationsController::class)->only([
                        'index'
                    ]);

                    // 通知统计
                    Route::get('notifications/stats', [NotificationsController::class, 'stats'])
                        ->name('notifications.stats');

                    // 标记消息通知为已读
                    Route::patch('user/read/notifications', [NotificationsController::class, 'read'])
                        ->name('user.notifications.read');

                    // 当前登录用户权限
                    Route::get('user/permissions', [PermissionsController::class, 'index'])
                        ->name('user.permissions.index');

                });
            });
    });
