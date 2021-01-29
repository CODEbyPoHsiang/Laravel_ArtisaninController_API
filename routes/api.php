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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/*-------------------------------------------------------------------------
/ ArtisanConsoleController   (將artisan 指令寫入 controller 製作成api)
/--------------------------------------------------------------------------*/
Route::prefix('artisan')->group(function () {
    //建立generate key
    Route::post('/key_generate', 'ArtisanConsoleController@key_generate');
    // 清除config快取
    Route::post('/config_clear', 'ArtisanConsoleController@config_clear');
    // 建立config快取
    Route::post('/config_cache', 'ArtisanConsoleController@config_cache');
    // 清除route快取
    Route::post('/route_clear', 'ArtisanConsoleController@route_clear');
    // 建立route快取
    Route::post('/route_cache', 'ArtisanConsoleController@route_cache');
    // 顯示route列表
    Route::get('/route_list', 'ArtisanConsoleController@route_list');
    // 建立migrate遷徙
    Route::post('/migrate', 'ArtisanConsoleController@migrate');
});