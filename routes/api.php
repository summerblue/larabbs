<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//v1版本
Route::prefix('v1')->name('api.v1.')->group(function() {
    //短信验证码
    Route::post('verificationCodes', [VerificationCodesController::class, 'store'])->name('verificationCodes.store');
});

//测试
// Route::prefix('v2')->name('api.v2.')->group(function() {
//     Route::get('version', function() {
//         return 'this version v2';
//     })->name('version');
// });
