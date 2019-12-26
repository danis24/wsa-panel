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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//@diceLogin
Route::post('/v1/login', 'Profiles\AccountController@diceLogin')->name('diceLogin');
//@diceLogin
Route::post('/v1/register', 'Profiles\AccountController@diceRegister')->name('diceRegister');
//@balances
Route::get('/v1/balances', 'Profiles\AccountController@balances')->name('profile.getBalances');
//@getCurrentBalance
Route::get('/v1/current-balances', 'Profiles\AccountController@getCurrentBalance')->name('profile.getCurrentBalance');
//@getDepositAddress
Route::get('/v1/deposit', 'Profiles\AccountController@getDepositAddress')->name('profile.getDepositAddress');
//@getDepositHistories
Route::get('/v1/deposit-histories', 'Profiles\AccountController@getDepositHistories')->name('profile.getDepositHistories');
//@createWithdraw
Route::post('/v1/create-withdraw', 'Profiles\AccountController@createWithdraw')->name('profile.createWithdraw');
//@getWithdrawl
Route::get('/v1/withdraw-histories', 'Profiles\AccountController@getWithdrawl')->name('profile.getWithdrawl');
//@getServerSeedHash
Route::get('/v1/seeds', 'Profiles\AccountController@getServerSeedHash')->name('profile.getServerSeedHash');

Route::get('/v1/bets', 'Profiles\AccountController@placeAutomatedBet')->name('profile.placeAutomatedBet');
