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

//Route::get('/hello', 'Hello@index');

Route::get('/', 'ImovelController@buscar')->name('inicio');

Route::get('/hello/adicionar', 'Hello@cadastro');
Route::post('/hello/postadicionar', 'Hello@postAdicionar');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Usuários */

Route::resource('usuario', 'UserController');
Route::get('/user/{id}', 'UserController@index');

/* Imóveis */

Route::get('/imovel/buscar', 'ImovelController@buscar')->name('Buscar Imóveis');
Route::get('/imovel/buscar/ver/{id}', array('uses' => 'ImovelController@show_buscar'))->name('Buscar Ver Imovel');


Route::get('/imovel', 'ImovelController@index')->name('Listar Imóveis');
Route::get('/imovel/adicionar', 'ImovelController@create')->name('Adicionar Imóvel');
Route::post('novo-imovel', array('uses' => 'ImovelController@store'));
Route::get('/imovel/ver/{id}', array('uses' => 'ImovelController@show'))->name('Ver Imovel');
Route::post('/imovel/getImoveisLista', array('uses' => 'ImovelController@getImoveisLista'));
Route::get('/imovel/getCidadesLista/{id}', array('uses' => 'ImovelController@showCidades'));
Route::get('/imovel/editar/{id}', array('as'=>'imovel.edit', 'uses' => 'ImovelController@edit'));
Route::put('imovel/update/{imovel}', array('as'=>'imovel.update', 'uses'=>'ImovelController@update'));
Route::delete('imovel/{imovel}', array('as'=>'imovel.destroy', 'uses'=>'ImovelController@destroy'));

/* imóveis */
Route::get('/imovel/{imovel}/leitura/{unidade}', array('uses' => 'ImovelController@leituraUnidade'));

Route::get('/imovel/{imovel}/ligar/{unidade}', array('uses' => 'ImovelController@ligarUnidade'));
Route::get('/imovel/{imovel}/desligar/{unidade}', array('uses' => 'ImovelController@desligarUnidade'));

Route::get('/imovel/{imovel}/atualizar', array('uses' => 'ImovelController@atualizarTodasLeituraUnidade'));



/* Agrupamentos */

Route::get('/agrupamento/adicionar', 'AgrupamentoController@create')->name('Adicionar Agrupamento');
Route::post('novo-agrupamento', array('uses' => 'AgrupamentoController@store'));
Route::get('/agrupamento/editar/{id}', array('as'=>'agrupamento.edit', 'uses' => 'AgrupamentoController@edit'));
Route::put('/agrupamento/update/{agrupamento}', array('as'=>'agrupamento.update', 'uses'=>'AgrupamentoController@update'));
Route::delete('/agrupamento/{agrupamento}', array('as'=>'agrupamento.destroy', 'uses'=>'AgrupamentoController@destroy'));

/* Unidades */

Route::get('/unidade/adicionar', 'UnidadeController@create')->name('Adicionar Unidade');
Route::get('/unidade/getAgrupamentoLista/{id}', array('uses' => 'UnidadeController@showAgrupamento'));
Route::post('nova-unidade', array('uses' => 'UnidadeController@store'));
Route::get('/unidade/editar/{id}', array('as'=>'unidade.edit', 'uses' => 'UnidadeController@edit'));
Route::put('/unidade/update/{unidade}', array('as'=>'unidade.update', 'uses'=>'UnidadeController@update'));
Route::delete('/unidade/{unidade}', array('as'=>'unidade.destroy', 'uses'=>'UnidadeController@destroy'));

/* Unidades */

Route::get('/prumada/adicionar', 'PrumadaController@create')->name('Adicionar Prumada');
Route::post('nova-prumada', array('uses' => 'PrumadaController@store'));

Route::get('/unidade/leitura/{unidade}', array('uses' => 'UnidadeController@leituraUnidade'));

Route::get('/unidade/ligar/{unidade}', array('uses' => 'UnidadeController@ligarUnidade'));
Route::get('/unidade/desligar/{unidade}', array('uses' => 'UnidadeController@desligarUnidade'));

Route::get('/leitura/export', 'Hello@export');

Route::get('/teste/leitura', 'Hello@testeLeitura');

Route::get('/teste/{id}', 'Hello@hidrometroTeste');

Route::get('/teste/ler/{id}', 'Hello@leituraTeste');
Route::get('/teste/ligar/{id}', 'Hello@ligarTeste');
Route::get('/teste/desligar/{id}', 'Hello@desligarTeste');

/* Clientes */
Route::get('/cliente', 'ClienteController@index')->name('Listar Clientes');
Route::get('/cliente/adicionar', 'ClienteController@create')->name('Adicionar Cliente');
Route::post('novo-cliente', array('uses' => 'ClienteController@store'));
Route::get('/cliente/editar/{id}', 'ClienteController@edit')->name('clinete.edit');
Route::put('/cliente/update/{id}', 'ClienteController@update')->name('clinete.update');


/* Equipamento */
Route::get('/equipamento/adicionar', 'EquipamentoController@create')->name('Adicionar Equipamento');
Route::post('novo-equipamento', array('uses' => 'EquipamentoController@store'));
Route::get('/equipamento/timeline', 'EquipamentoController@timeline')->name('Timeline');

/* Relatorios */

Route::get('/relatorio/consumo', 'Hello@relatorioConsumo')->name('Relatorio Consumo');
Route::get('/relatorio/faturas', 'Hello@relatorioFatura')->name('Relatorio Fatura');
