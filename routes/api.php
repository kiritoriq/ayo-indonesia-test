<?php

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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
return $request->user();
}); */

Route::group(['prefix' => 'v1', 'namespace' => 'v1'], function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@auth')->name('api.auth');
        Route::post('logout', 'AuthController@logout_api')->name('api.logout');
    });
});

Route::get('get-data-sentravaksin', 'Auth\RegisterController@getDataVaksin')->name('api.data-vaksin');
