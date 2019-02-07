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
Route::get('/user/{id}/create', array('uses' => 'UserController@create_user'))->name('Create User');
Route::get('/user/editar/{id}', array('as'=>'user.edit', 'uses' => 'UserController@edit_user'));

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

//Route::get('/unidade/leitura/{unidade}', array('uses' => 'UnidadeController@leituraUnidade'));

Route::get('/unidade/ligar/{unidade}', array('uses' => 'UnidadeController@ligarUnidade'));
Route::get('/unidade/desligar/{unidade}', array('uses' => 'UnidadeController@desligarUnidade'));

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
Route::get('/equipamento/adicionar', 'PrumadaController@create')->name('Adicionar Equipamento');
Route::post('novo-equipamento', array('uses' => 'PrumadaController@store'));
Route::get('/equipamento/editar/{id}', array('as'=>'prumada.edit', 'uses' => 'PrumadaController@edit'));
Route::put('/equipamento/update/{unidade}', array('as'=>'prumada.update', 'uses'=>'PrumadaController@update'));
Route::delete('/equipamento/{unidade}', array('as'=>'prumada.destroy', 'uses'=>'PrumadaController@destroy'));
Route::get('/equipamento/getAgrupamentoLista/{id}', array('uses' => 'PrumadaController@showAgrupamento'));
Route::get('/equipamento/getUnidadeLista/{id}', array('uses' => 'PrumadaController@showUnidade'));

/* TimeLine */

Route::get('/timeline/equipamento/buscar', 'TimelineController@buscar')->name('Timeline Buscar Equipamento');
Route::get('/timeline/equipamento', 'TimelineController@index')->name('Timeline Equipamento');
Route::get('/timeline/equipamento/adicionar', 'TimelineController@create')->name('Adicionar TimeLine Equipamento');
Route::post('novo-equipamento-timeline', array('uses' => 'TimelineController@store'));
Route::get('/timeline/equipamento/getEquipamentoLista/{id}', array('uses' => 'TimelineController@showPrumada'));
Route::post('/timeline/equipamento/getTimelineLista', array('uses' => 'TimelineController@getTimelineLista'));

Route::get('/server/test', 'TimelineController@serverTest')->name('Teste de Conexão Servidor');
Route::post('/server/test', array('uses' => 'TimelineController@getServerTest'));

/* Relatorios */

Route::get('/relatorio/consumo', 'RelatorioController@relatorioConsumo')->name('Relatorio Consumo');
Route::post('relatorio/consumo', array('uses' => 'RelatorioController@getConsumoLista'));

Route::get('/relatorio/faturas', 'RelatorioController@relatorioFatura')->name('Relatorio Fatura');
Route::post('relatorio/faturas', array('uses' => 'RelatorioController@getFaturaLista'));
Route::get('relatorio/faturas/getApartamentoLista/{id}', array('uses' => 'RelatorioController@showUnidade'));
