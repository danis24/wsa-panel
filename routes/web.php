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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/accounts', 'HomeController@index')->name('home.accounts');
Route::get('/target', 'HomeController@index')->name('home.target');
Route::get('/detail/{id}', 'HomeController@index')->name('home.target');
Route::get('/target/add', 'HomeController@index')->name('home.target');
Route::get('/settings', 'HomeController@index')->name('setting.view');
Route::get('/user-manual', 'HomeController@index')->name('setting.view');
Route::get('/pdf/{id}', 'HomeController@generatePDF');
