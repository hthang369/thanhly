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

Route::group(['prefix' => ''], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/dich-vu/{title}', 'PostController@show')->name('page.show-post');
    Route::post('/send-mail', 'HomeController@sendMail')->name('page.send-mail');
    // Route::get('/detail/{title}', 'HomeController@showPostDetail')->name('page.show-detail');

    Route::get('/{title}', 'HomeController@show')->name('page.show');
});
