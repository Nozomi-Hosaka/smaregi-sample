<?php

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

use App\Http\Controllers\Actions\SmaregiApiToken\SmaregiApiTokenAcceptAction;
use App\Http\Controllers\Actions\Webhook\SmaregiWebhookAcceptAction;
use App\Http\Controllers\Apis\Actions\Category\CreateCategoryAction;
use App\Http\Controllers\Apis\Actions\SmaregiApiToken\GetSmaregiApiTokenAction;
use App\Http\Controllers\Apis\Actions\SmaregiApiToken\SaveSmaregiApiTokenAction;
use App\Http\Controllers\Apis\Actions\Webhook\GetWebhookLogAction;
use App\Http\Middleware\SmaregiWebhookMiddleware;

Route::middleware('auth:api')->group(static function () {
    // TODO: ログイン基盤作成あとに移行
});

Route::prefix('pos')->group(static function () {
    Route::prefix('category')->group(static function () {
        Route::post('/', CreateCategoryAction::class);
    });
});

Route::prefix('webhook')->group(static function () {
    Route::get('/', GetWebhookLogAction::class);
});

Route::prefix('smaregi')->group(static function () {
    Route::prefix('webhook')
        ->middleware(SmaregiWebhookMiddleware::class)
        ->group(static function () {
            Route::post('/', SmaregiWebhookAcceptAction::class);
        });
    Route::prefix('token')->group(static function () {
        Route::get('/', GetSmaregiApiTokenAction::class);
        Route::post('/', SaveSmaregiApiTokenAction::class);
        Route::prefix('accept')->group(static function () {
            Route::post('/', SmaregiApiTokenAcceptAction::class);
        });
    });
});
