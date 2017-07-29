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

// frontend
Route::get('/','Index\IndexController@index')->name('/');


// backend
Route::group(['prefix' => 'yexk'], function () {
    Route::get('/', 'Back\LoginController@index')->name('/');
    // login 
    Route::post('login', 'Back\LoginController@loginCheck')->name('login');
    Route::get('logout', 'Back\HomeController@logout')->name('logout');

    // home 
    Route::get('/home', 'Back\HomeController@index')->name('home');

    // categroy
    Route::get('/cate/add', 'Back\CategoriesController@add')->name('cate.add');
    Route::post('/cate/store', 'Back\CategoriesController@store')->name('cate.store');
    Route::get('/cate/lists', 'Back\CategoriesController@lists')->name('cate.lists');
    Route::match(['get', 'post'],'/cate/edits', 'Back\CategoriesController@edits')->name('cate.edits');
    
    // article
    Route::get('/art/add','Back\ArticlesController@add')->name('art.add');
    Route::get('/art/lists','Back\ArticlesController@lists')->name('art.lists');
    Route::post('/art/store', 'Back\ArticlesController@store')->name('art.store');
    Route::match(['get', 'post'],'/art/{id}/lists','Back\ArticlesController@edited')->where('id', '[0-9]+')->name('art.edited');

    // user manger
    Route::get('/users/lists','Back\UsersController@lists')->name('users.lists');
    Route::post('/users/add','Back\UsersController@add')->name('users.add');
    
    // email manger
    Route::get('/mail/inbox','Back\EmailsController@inbox')->name('mail.inbox');
    Route::post('/mail/send','Back\EmailsController@sendMail')->name('mail.send');
    

    
});