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

Route::group(['middleware' => ['auth:web', 'info-web'], 'prefix' => 'admin'], function() {
    Route::group(['prefix' => 'setting'], function() {
        Route::get('{id}', 'SettingController@view')->name('setting.view');
        Route::get('view/sort', 'SettingController@sort')->name('setting.sort');
    });
    Route::resource('setting', 'SettingController');
    Route::group(['prefix' => 'attributes'], function() {
        Route::get('sort', 'Attributes\AttributesController@sort')->name('attributes.sort');
        Route::put('sort', 'Attributes\AttributesController@updateSort')->name('attributes.update-sort');
    });
    
    Route::resource('attributes', 'Attributes\AttributesController');
    Route::resource('widget', 'WidgetController');
    Route::group(['prefix' => 'widget'], function() {
        Route::get('create/{id}', 'WidgetController@create')->name('widget.new');
    });
});
