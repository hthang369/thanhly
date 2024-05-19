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

Route::middleware('auth:api')->get('/api', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::get('list-news', 'NewsController@listNews');
    Route::get('detail-news/{id}', 'NewsController@showNews');

    Route::post('send-mail', 'ContactsController@sendMail')->name('page.send-mail');
    Route::post('domain-search', 'DomainController@search')->name('page.domain-search');
    Route::post('upload-file', 'NewsController@uploadFile')->name('page.upload-file');
});
