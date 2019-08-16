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
Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/', 'ImovelController@buscar')->name('inicio');
  
    
    
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::post('importar/csv', 'TesteController@process')->middleware('permissao:administrador');
    
    /* Usuários */
    
    Route::resource('usuario', 'UserController', [
        'middleware' => [
            'edit' => 'permissao:administrador',
            'create' => 'permissao:administrador',
            'destroy' => 'permissao:administrador'
            ]
    ]);
    Route::get('usuario/tipo/{tipo}', 'UserController@index')->middleware('permissao:administrador');
    Route::get('/perfil', 'UserController@perfil');
    
    /* Imóveis 
    Route::prefix('imovel')->group(function () {
        Route::get('buscar', 'ImovelController@buscar')->middleware('permissao:administrador');
        Route::get('buscar/ver/{imovel}', 'ImovelController@show_buscar')->middleware('permissao:administrador');
        
    });*/

    Route::resource('/imovel', 'ImovelController', [
        'middleware' => [
            'index' => 'permissao:administrador,sindico',
            'create' => 'permissao:administrador',
            'store' => 'permissao:administrador',
            'edit' => 'permissao:administrador,sindico',
            'update' => 'permissao:administrador',
            'destroy' => 'permissao:administrador'
        ]
    ]);
    

    Route::get('/imovel/{id}/consumo', 'ImovelController@getLancarConsumo')->name('imovel.consumo')->middleware('permissao:administrador,sindico');
    
    Route::post('/imovel/getImoveisLista', array('uses' => 'ImovelController@getImoveisLista'));
    Route::get('/imovel/getCidadesLista/{id}', array('uses' => 'ImovelController@showCidades'));

    Route::post('lancar-consumo', array('uses' => 'ImovelController@postLancarConsumo'));
    
    /* imóveis */
    Route::get('/leitura/prumada/{prumada}', array('uses' => 'ImovelController@leituraUnidade'));
    
    Route::get('/imovel/{imovel}/ligar/{unidade}', array('uses' => 'ImovelController@ligarUnidade'));
    Route::get('/imovel/{imovel}/desligar/{unidade}', array('uses' => 'ImovelController@desligarUnidade'));
    
    Route::get('/imovel/{imovel}/atualizar', array('uses' => 'ImovelController@atualizarTodasLeituraUnidade'));
    
    
    
    /* Agrupamentos */
    
    Route::get('/agrupamento/adicionar', 'AgrupamentoController@create')->name('Adicionar Agrupamento');
    Route::post('novo-agrupamento', array('uses' => 'AgrupamentoController@store'));
    Route::get('/agrupamento/editar/{agrupamento}', array('as'=>'agrupamento.edit', 'uses' => 'AgrupamentoController@edit'))->middleware('permissao:administrador');
    Route::put('/agrupamento/update/{agrupamento}', array('as'=>'agrupamento.update', 'uses'=>'AgrupamentoController@update'));
    Route::delete('/agrupamento/{agrupamento}', array('as'=>'agrupamento.destroy', 'uses'=>'AgrupamentoController@destroy'));
    
    /* Unidades */
    
    Route::get('/unidade/adicionar', 'UnidadeController@create')->name('Adicionar Unidade');
    Route::get('/unidade/getAgrupamentoLista/{id}', array('uses' => 'UnidadeController@showAgrupamento'));
    Route::post('nova-unidade', array('uses' => 'UnidadeController@store'));
    Route::get('/unidade/editar/{id}', array('as'=>'unidade.edit', 'uses' => 'UnidadeController@edit'));
    Route::get('/unidade/ver/{id}', array('uses' => 'UnidadeController@show'))->name('Ver Unidade');
    Route::put('/unidade/update/{unidade}', array('as'=>'unidade.update', 'uses'=>'UnidadeController@update'));
    Route::delete('/unidade/{unidade}', array('as'=>'unidade.destroy', 'uses'=>'UnidadeController@destroy'));
    
    //Unidade_User
    Route::get('/unidade/editar/{id}/user/create', array('as'=>'unidade.create_user', 'uses' => 'UnidadeController@create_user'));
    Route::post('nova-unidade-user', array('uses' => 'UnidadeController@store_user'));
    Route::get('/unidade/editar/{id}/user/editar/{id_user}', array('as'=>'unidade.edit_user', 'uses' => 'UnidadeController@edit_user'));
    Route::put('/unidade/update/{id}/user/{id_user}', array('as'=>'unidade.update_user', 'uses'=>'UnidadeController@update_user'));
    Route::delete('/unidade/{id}/user/{id_user}', array('as'=>'unidade.destroy_user', 'uses'=>'UnidadeController@destroy_user'));
    
    //Unidade_User_Existente
    Route::get('/unidade/editar/{id}/user/existente', array('as'=>'unidade.add_user_existente', 'uses' => 'UnidadeController@add_user_existente'));
    Route::post('nova-unidade-user-existente', array('uses' => 'UnidadeController@store_user_existente'));
    
    // Desvincular usuario à unidade
    Route::delete('/unidade/{id}/user/desvincular/{id_user}', array('as'=>'unidade.desvincular_user', 'uses'=>'UnidadeController@desvincular_user'));
    
    /* Unidades */
    
    Route::get('/prumada/adicionar', 'PrumadaController@create')->name('Adicionar Prumada');
    
    //Route::get('/unidade/leitura/{unidade}', array('uses' => 'UnidadeController@leituraUnidade'));
    
    Route::get('/unidade/ligar/{unidade}', array('uses' => 'UnidadeController@ligarUnidade'));
    Route::get('/unidade/desligar/{unidade}', array('uses' => 'UnidadeController@desligarUnidade'));

    /* Clientes */
    Route::resource('cliente', 'ClienteController')->middleware('permissao:administrador');
    /*
    Route::get('/cliente', 'ClienteController@index')->name('Listar Clientes');
    Route::get('/cliente/adicionar', 'ClienteController@create')->name('Adicionar Cliente');
    Route::post('novo-cliente', array('uses' => 'ClienteController@store'));
    Route::get('/cliente/ver/{cliente}', array('uses' => 'ClienteController@show'))->name('Ver Cliente');
    Route::get('/cliente/editar/{cliente}', 'ClienteController@edit')->name('clinete.edit');
    Route::put('/cliente/update/{cliente}', 'ClienteController@update')->name('clinete.update');
    Route::delete('cliente/{cliente}', array('as'=>'cliente.destroy', 'uses'=>'ClienteController@destroy'));
    */
    
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
    Route::get('importar/csv', 'TesteController@uploadCsv');
    
    /* Relatorios */
    
    Route::get('/relatorio/consumo', 'RelatorioController@relatorioConsumo')->name('Relatorio Consumo');
    Route::post('relatorio/consumo', array('uses' => 'RelatorioController@getConsumoLista'));
    
    Route::get('/relatorio/faturas', 'RelatorioController@relatorioFatura')->name('Relatorio Fatura');
    Route::post('relatorio/faturas', array('uses' => 'RelatorioController@getFaturaLista'));
    Route::get('relatorio/faturas/getApartamentoLista/{id}', array('uses' => 'RelatorioController@showUnidade'));

});


Route::get('criar-duas-prumadas', 'PrumadaController@criarDuas');
Route::any('teste', 'TesteController@teste')->middleware('guest') ;

Route::get('cidades/{estado_id}', function($estado_id) {
    return \App\Models\Cidade::where('estado_id', $estado_id)->get();
});
