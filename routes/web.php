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
Route::get('/imovel/editar/{id}', array('as'=>'imovel.edit', 'uses' => 'ImovelController@edit'));
Route::put('imovel/update/{imovel}', array('as'=>'imovel.update', 'uses'=>'ImovelController@update'));

/* imóveis */
Route::get('/imovel/{imovel}/leitura/{unidade}', array('uses' => 'ImovelController@leituraUnidade'));

Route::get('/imovel/{imovel}/ligar/{unidade}', array('uses' => 'ImovelController@ligarUnidade'));
Route::get('/imovel/{imovel}/desligar/{unidade}', array('uses' => 'ImovelController@desligarUnidade'));

Route::get('/imovel/{imovel}/atualizar', array('uses' => 'ImovelController@atualizarTodasLeituraUnidade'));

Route::get('/imovel/todos', 'ImovelController@showdown')->name('Todos os Imóveis');



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

Route::get('/unidade/leitura/{unidade}', array('uses' => 'UnidadeController@leituraUnidade'));

Route::get('/unidade/ligar/{unidade}', array('uses' => 'UnidadeController@ligarUnidade'));
Route::get('/unidade/desligar/{unidade}', array('uses' => 'UnidadeController@desligarUnidade'));


Route::get('/teste/leitura', 'Hello@testeLeitura');

Route::get('/teste', 'Hello@hidrometroTeste');

Route::get('/teste/ler', 'Hello@leituraTeste');
Route::get('/teste/ligar', 'Hello@ligarTeste');
Route::get('/teste/desligar', 'Hello@desligarTeste');

/* Clientes */
Route::get('/cliente', 'ClienteController@index')->name('Listar Clientes');
Route::get('/cliente/adicionar', 'ClienteController@create')->name('Adicionar Cliente');
Route::post('novo-cliente', array('uses' => 'ClienteController@store'));

/* Equipamento */
Route::get('/equipamento/adicionar', 'EquipamentoController@create')->name('Adicionar Equipamento');
Route::post('novo-equipamento', array('uses' => 'EquipamentoController@store'));
Route::get('/equipamento/timeline', 'EquipamentoController@timeline')->name('Timeline');