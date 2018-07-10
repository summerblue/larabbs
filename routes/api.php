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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');

//$api->version('v1', function($api){
//    $api->get('version',function(){
//        return response('this is version v1');
//    });
//});
//
//$api->version('v2', function($api){
//    $api->get('version', function(){
//        return response('this is version v2');
//    });
//});

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function($api) {
    // 短信验证码
    $api->post('verificationCodes', 'VerificationCodesController@store')
        ->name('api.verificationCodes.store');
    //用户注册
    $api->post('users','UsersController@store')
        ->name('api.users.store');
});
