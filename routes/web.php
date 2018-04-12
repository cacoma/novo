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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users', 'UserController');

Route::get('/indexinvests', 'InvestController@indexinvests'); //puxar todos os invests
Route::resource('invests', 'InvestController');
Route::put('/brokers/{id}', 'BrokerController@update');//para update de corretora no bd
Route::get('/broker/{id}', 'BrokerController@detail');//para mostrar detalhe de corretora no bd
Route::resource('brokers', 'BrokerController');
//caso investimento seja de stocks, usa uma das rotas abaixo

Route::get('/stock/{id}', 'StockController@detail'); //para mostrar detalhe de acoes no bd
Route::put('/stocks/{id}', 'StockController@update'); //para update de acoes no bd
Route::post('/stocks/investstore', 'StockController@investstore'); //investimentos de acoes
Route::get('/stocks/{id}/investedit', 'StockController@investedit'); //investimentos de acoes
Route::patch('/stocks/investupdate', 'StockController@investupdate'); //investimentos de acoes
Route::post('/stocks/investupdate', 'StockController@investupdate');//investimentos de acoes
//resource tem que ficar abaixo para nao atrapalhar as de cima
Route::resource('stocks', 'StockController');
Route::post('/monthlyQuotes/store', 'MonthlyQuotesController@store');
Route::resource('monthlyQuotes', 'MonthlyQuotesController');


//Route::view('/welcome', 'welcome');
//Route::get('/stocks/stockinvestedit/{id}', 'StockController@stockinvestedit');

