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
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::get('/prediction', 'PredictionsController@index');
Route::get('/test', 'TestController@index');

Route::get('/user/settings', 'ProfilesController@index')->name('apisettings');

Route::get('/trading', 'TradesController@index');
Route::post('/trading', 'TradesController@store');

//Route::get('/autotrade', 'AutoTrading@index');

Route::get('/my-portfolio', 'PortfoliosController@index');


