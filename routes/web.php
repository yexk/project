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
    // home 
    Route::get('/home', 'Back\HomeController@index')->name('home');

    // categroy
    Route::get('/cate/add', 'Back\CategoriesController@add')->name('art.add');
    Route::post('/cate/store', 'Back\CategoriesController@store')->name('art.store');
    


});