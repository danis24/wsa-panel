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
Route::get('/settings', 'HomeController@index')->name('setting.view');
Route::get('/settings/loads', 'HomeController@index')->name('setting.load');
Route::get('/settings/collections', 'Settings\SettingController@browse')->name('setting.browse');
Route::post('/settings/create', 'Settings\SettingController@create')->name('setting.create');
Route::delete('/settings/collections/{id}', 'Settings\SettingController@delete')->name('setting.delete');
