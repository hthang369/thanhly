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

    Route::get('tree-folder', 'MediaController@treeFolders')->name('media.tree-folder');
    Route::post('folder/content', 'MediaController@folderContent')->name('media.folder-detail');
    Route::post('folder/create', 'MediaController@folderCreate')->name('media.folder-create');
    Route::post('folder/delete', 'MediaController@folderDelete')->name('media.folder-delete');
    Route::post('file/upload', 'MediaController@fileUpload')->name('media.file-upload');
    Route::delete('file/delete/{folder}', 'MediaController@fileDelete')->name('media.file-delete');
});
