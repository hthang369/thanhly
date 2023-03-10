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

Route::middleware('auth:api')->get('/setting', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::group(['prefix' => 'setting'], function() {
        Route::put('{id}/edit', 'SettingController@update')->name('setting.update');
        Route::put('sort', 'SettingController@updateSort')->name('setting.sort-update');
    });

    Route::group(['prefix' => 'widget'], function() {
        Route::post('save-widget/{id}', 'WidgetController@update')->name('widget.save');
        Route::delete('delete-widget/{id}', 'WidgetController@delete')->name('widget.delete');
    });
});