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
Route::get('/','Index\IndexController@index');


// backend
Route::group(['prefix' => 'yexk'], function () {
    Route::get('/', 'Back\LoginController@index');
    


});