<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Apis\Actions\SmaregiApiToken\GetSmaregiApiTokenAction;

Route::get('/', function () {
    return view('vue');
})->name('top');

// TODO: ログイン基盤作成あとに移行
Route::prefix('api')->group(static function () {
    Route::prefix('smaregi')->group(static function () {
        Route::prefix('token')->group(static function () {
            Route::get('/', GetSmaregiApiTokenAction::class);
        });
    });
});

Route::get('/{controller?}/{action?}/{any?}', function () {
    return view('vue');
});
