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

Route::get('/', 'PageController@getIndex');
Route::get('/loginRegis', 'PageController@getLogin');
Route::get('/accountSetting', 'PageController@getAccountSetting');
Route::get('/upload', 'PageController@getUpload');
Route::get('/contact', 'PageController@getContact');

Route::get('/logout', 'Auth\LoginController@logoutReq');






Route::post('/login', 'Auth\LoginController@processReq');
Route::post('/register', 'Auth\RegisterController@processReq');
Route::resource('/fileUpload', 'ImageController');

Route::get('/{id?}', 'PageController@getIndex');