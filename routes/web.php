<?php

Route::get('/', 'TopicsController@index')->name('root');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('users/{user}/barcode', 'UsersController@barcode')->name('users.barcode');
Route::post('users/{user}/qrcode', 'UsersController@downloadQrcode')->name('users.qrcode');
Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

// 话题 excel
Route::get('topics/excel', 'TopicsController@excel')->name('topics.excel');
Route::post('topics/export', 'TopicsController@export')->name('topics.export');
Route::post('topics/import', 'TopicsController@import')->name('topics.import');


Route::get('topics/{topic}/image', 'TopicsController@image')->name('topics.image');
Route::get('topics/{topic}/pdf', 'TopicsController@pdf')->name('topics.pdf')->middleware('cacheResponse:60');


Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::get('zip', 'ZipController@index')->name('zip.index');
Route::post('zip/download', 'ZipController@download')->name('zip.download');
Route::post('zip/upload', 'ZipController@upload')->name('zip.upload');

Route::get('sitemap', 'SitemapController@index')->name('sitemap.index');
Route::get('sitemap/topics', 'SitemapController@topics')->name('sitemap.topics.index');
Route::get('sitemap/users', 'SitemapController@users')->name('sitemap.users.index');



Route::get('app', function() {
    dump(123);
    if (!Agent::isMobile()) {
        return response('PC 访问');
    }

    if (Agent::isiOS()) {
        if (str_contains(Agent::getUserAgent(), 'MicroMessenger')) {
            return response('请使用 safari 打开下载');
        }

        return response('https://itunes.apple.com/xxxx');
    }
});

Route::get('decompose','\Lubusin\Decomposer\Controllers\DecomposerController@index');

Route::get('decompose/json', function() {
    dd(Lubusin\Decomposer\Decomposer::getReportJson());
});

Route::get('decompose/array', function() {
    dd(Lubusin\Decomposer\Decomposer::getReportArray());
});

