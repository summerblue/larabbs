<?php

use Illuminate\Http\Request;

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

Route::prefix('v1')->namespace('Api')
                   ->name('api.v1.')
                   ->middleware('throttle:'.config('api.rate_limits.sign'))
                   ->group(function () {
    // 图片验证码
    Route::post('captchas', 'CaptchasController@store')
		->name('api.captchas.store');
    // 短信验证码
    Route::post('verificationCodes', 'VerificationCodesController@store')
        ->name('verificationCodes.store');
    // 用户注册
    Route::post('users', 'UsersController@store')
        ->name('users.store');
});
