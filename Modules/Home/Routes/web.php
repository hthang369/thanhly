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
    Route::get('/service/{title}', 'CategoryController@show')->name('page.show-service');
    Route::get('/category/{title}', 'CategoryController@show')->name('page.show-category');
    Route::get('/category/{title}/{brand}', 'CategoryController@showBrand')->name('page.show-brand');
    Route::get('/product/{title}', 'ProductController@show')->name('page.show-product');
    Route::get('/news/{title}', 'CategoryController@show')->name('page.show-news');
    Route::post('/send-mail', 'HomeController@sendMail')->name('page.send-mail');
    Route::get('/post/{title}', 'PostController@show')->name('page.show-detail');
    Route::get('test', 'HomeController@test')->name('page.test');

    Route::get('/{title}', 'PageController@show')->name('page.show');
});
