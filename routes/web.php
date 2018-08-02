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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'ImovelController@index')->name('Listar Imóveis');

Route::get('/hello', 'Hello@index');
Route::get('/hello/adicionar', 'Hello@cadastro');
Route::post('/hello/postadicionar', 'Hello@postAdicionar');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Imóveis */

Route::get('/imovel', 'ImovelController@index')->name('Listar Imóveis');
Route::get('/imovel/adicionar', 'ImovelController@create')->name('Adicionar Imóvel');
Route::post('novo-imovel', array('uses' => 'ImovelController@store'));
Route::get('/imovel/ver/{id}', array('uses' => 'ImovelController@show'));
Route::post('/imovel/getImoveisLista', array('uses' => 'ImovelController@getImoveisLista'));

/* Agrupamentos */

Route::get('/agrupamento/ver/{id}', array('uses' => 'AgrupamentoController@show'));
Route::get('/agrupamento/adicionar', 'AgrupamentoController@create')->name('Adicionar Agrupamento');
Route::post('novo-agrupamento', array('uses' => 'AgrupamentoController@store'));

/* Unidades */

Route::get('/unidade/ver/{id}', array('uses' => 'UnidadeController@show'));
Route::get('/unidade/adicionar', 'UnidadeController@create')->name('Adicionar Unidade');
Route::post('nova-unidade', array('uses' => 'UnidadeController@store'));

/* Unidades */

Route::get('/prumada/adicionar', 'PrumadaController@create')->name('Adicionar Prumada');
Route::post('nova-prumada', array('uses' => 'PrumadaController@store'));