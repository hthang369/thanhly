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

Route::prefix('')->group(function() {
    Route::get('/', 'WebDesignController@index')->name('page.index');

    Route::get('/category/{title}', 'CategoryController@show')->name('page.show-post');

    Route::get('/post/{title}', 'PostController@show')->name('page.show-detail');

    Route::get('/product/{title}', 'ProductController@show')->name('page.show-product');
    Route::get('/preview/{title}', 'ProductController@preview')->name('page.preview');

    Route::get('/{title}', 'PageController@show')->name('page.show');
});
