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
    Route::get('/category/{title}', 'WebDesignController@showPost')->name('page.show-post');
    Route::get('/post/{title}', 'WebDesignController@showPostDetail')->name('page.show-detail');
    Route::get('/preview/{title}', 'WebDesignController@preview')->name('page.preview');
    Route::get('/{title}', 'WebDesignController@show')->name('page.show');
});
