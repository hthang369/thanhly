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
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::resource('posts', 'PostsController');
    Route::resource('news', 'NewsController');
    Route::resource('pages', 'PagesController');
    Route::resource('products', 'ProductsController');
    Route::resource('brands', 'BrandsController');
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/post', 'CategoriesController@viewPost')->name('categories.post.index');
        Route::get('/news', 'CategoriesController@viewNews')->name('categories.news.index');
        Route::get('/product', 'CategoriesController@viewProduct')->name('categories.products.index');
        Route::get('/create/{type}', 'CategoriesController@create')->name('categories.create');
    });
    Route::resource('categories', 'CategoriesController', ['except' => ['create']]);

    Route::resource('menus', 'MenusController', ['except' => ['index', 'create', 'edit']]);

    Route::get('view-menus/{menu?}', 'MenusController@view')->name('menus.index');
    Route::get('menus/create/{menu?}', 'MenusController@create')->name('menus.create');
    Route::get('menus/{id}/edit/{menu?}', 'MenusController@edit')->name('menus.edit');
    Route::get('menus/sort-order/{menu?}', 'MenusController@sort')->name('menus.sort');
    Route::put('menus/sort-order/{menu?}', 'MenusController@updateSort')->name('menus.sort-update');

    Route::resource('slides', 'SlidesController', ['except' => ['update']]);
    Route::post('slides/{slides}', 'SlidesController@update')->name('slides.update');

    Route::resource('advertises', 'AdvertisesController', ['except' => ['update']]);
    Route::post('advertises/{advertise}', 'AdvertisesController@update')->name('advertises.update');

    Route::resource('roles', 'RolesController')->names('role');

    Route::resource('permission-role', 'PermissionRoleController')->names('role_has_permissions');

    Route::group(['prefix' => 'users'], function() {
        Route::get('account-info', 'UsersController@accountInfo')->name('users.account-info');
        Route::put('account-info/{id}', 'UsersController@updateAccount')->name('users.update-account');
        Route::put('change-pass/{id}', 'UsersController@updateChangePass')->name('users.update-pass');
    });
    Route::resource('users', 'UsersController');

    Route::resource('contacts', 'ContactsController')->names('contact');
});
