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

    Route::get('/', function () {
        return redirect('/imovel');
    });
    
    Route::get('/home', 'HomeController@index')->name('home')->middleware('permissao:administrador,sindico,secretario');
    
    Route::post('importar/csv', 'TesteController@process')->middleware('permissao:administrador,sindico');
    
    /* Usuários */
    
    Route::resource('usuario', 'UserController', [
        'middleware' => [
            'edit' => 'permissao',
            'create' => 'permissao',
            'destroy' => 'permissao'
        ]
    ]);
    Route::get('usuario/tipo/{tipo}', 'UserController@index')->middleware('permissao');
    Route::get('/perfil', 'UserController@perfil');
    
    // Imóveis 
    Route::prefix('imovel')->middleware('permissao:administrador,sindico')->group(function () {
        Route::get('buscar', 'ImovelController@buscar');
        Route::get('buscar/ver/{imovel}', 'ImovelController@show_buscar');
        Route::get('/lista/{cidade}', 'ImovelController@lista');
        
    });

    Route::get('imovel/{imovel}/unidade', 'ImovelController@unidade');
    Route::get('imovel/{imovel}/agrupamento', 'ImovelController@agrupamento');
    Route::resource('/imovel', 'ImovelController', [
        'middleware' => [
            'index' => 'permissao:administrador,sindico',
            'create' => 'permissao',
            'store' => 'permissao',
            'view' => 'permissao:administrador,sindico',
            'edit' => 'permissao:administrador,sindico',
            'update' => 'permissao:administrador,sindico',
            'destroy' => 'permissao'
        ]
    ]);
    

    Route::get('/imovel/{imovel}/consumo', 'ImovelController@getLancarConsumo')->name('imovel.consumo')->middleware('permissao:administrador,sindico');
    
    Route::post('lancar-consumo', array('uses' => 'ImovelController@postLancarConsumo'));
    
    Route::get('/imovel/getCidadesLista/{id}', array('uses' => 'ImovelController@showCidades'));

    
    /* imóveis */
    Route::get('/leitura/prumada/{prumada}', array('uses' => 'ImovelController@leituraUnidade'));
    
    Route::get('/imovel/{imovel}/ligar/{unidade}', array('uses' => 'ImovelController@ligarUnidade'));
    Route::get('/imovel/{imovel}/desligar/{unidade}', array('uses' => 'ImovelController@desligarUnidade'));
    
    
    /* Agrupamentos */
    
  /*  Route::get('/agrupamento/e', 'AgrupamentoController@create')->name('Adicionar Agrupamento');
    Route::post('novo-agrupamento', array('uses' => 'AgrupamentoController@store'));
    Route::get('/agrupamento/editar/{agrupamento}', array('as'=>'agrupamento.edit', 'uses' => 'AgrupamentoController@edit'))->middleware('permissao:administrador');
    Route::put('/agrupamento/update/{agrupamento}', array('as'=>'agrupamento.update', 'uses'=>'AgrupamentoController@update'));
    Route::delete('/agrupamento/{agrupamento}', array('as'=>'agrupamento.destroy', 'uses'=>'AgrupamentoController@destroy'));
    */
    Route::get('agrupamento/unidade/{agrupamento}', 'AgrupamentoController@unidade');
    Route::resource('agrupamento', 'AgrupamentoController', [
        'middleware' => [
            'create' => 'permissao',
            'store' => 'permissao',
            'view' => 'permissao',
            'edit' => 'permissao:administrador,sindico',
            'update' => 'permissao:administrador,sindico',
            'destroy' => 'permissao'
        ]
    ])->except(['index', 'show']);
    /* Unidades */



    /*
    
    Route::get('/unidade/adicionar', 'UnidadeController@create')->name('Adicionar Unidade');
    Route::get('/unidade/getAgrupamentoLista/{id}', array('uses' => 'UnidadeController@showAgrupamento'));
    Route::post('nova-unidade', array('uses' => 'UnidadeController@store'));
    Route::get('/unidade/editar/{id}', array('as'=>'unidade.edit', 'uses' => 'UnidadeController@edit'));
    Route::get('/unidade/ver/{id}', array('uses' => 'UnidadeController@show'))->name('Ver Unidade');
    Route::put('/unidade/update/{unidade}', array('as'=>'unidade.update', 'uses'=>'UnidadeController@update'));
    Route::delete('/unidade/{unidade}', array('as'=>'unidade.destroy', 'uses'=>'UnidadeController@destroy'));
    */
    
    Route::resource('unidade', 'UnidadeController', [
        'middleware' => [
            'create' => 'permissao',
            'store' => 'permissao',
            'view' => 'permissao',
            'edit' => 'permissao:administrador,sindico',
            'update' => 'permissao:administrador,sindico',
            'destroy' => 'permissao'
        ]
    ]);


    //Unidade_User
    Route::get('usuario/{unidade}/unidade', 'UserController@unidade')
        ->name('usuario.unidade')->middleware('permissao');
    Route::post('usuario/{unidade}/unidade/store', 'UserController@unidadeStore')
        ->name('usuario.unidade.store')->middleware('permissao');
    
    Route::get('/unidade/editar/{id}/user/editar/{id_user}', 'UnidadeController@edit_user')
        ->name('unidade.edit_user')->middleware('permissao');
    Route::put('/unidade/update/{id}/user/{id_user}', array('as'=>'unidade.update_user', 'uses'=>'UnidadeController@update_user'));
    
    //Unidade_User_Existente
    Route::get('/unidade/{unidade}/user/existente', 'UnidadeController@add_user_existente')
        ->name('unidade.add_user_existente')->middleware('permissao');
    Route::post('/unidade/{unidade}/user/existente', 'UnidadeController@store_user_existente')
        ->middleware('permissao');
    
    // Desvincular usuario à unidade
    Route::delete('/unidade/desvincular/{user}', 'UnidadeController@desvincular_user')
        ->name('unidade.desvincular_user')->middleware('permissao');
    
    
    Route::get('/unidade/ligar/{unidade}', array('uses' => 'UnidadeController@ligarUnidade'));
    Route::get('/unidade/desligar/{unidade}', array('uses' => 'UnidadeController@desligarUnidade'));

    // clientes 
    Route::resource('cliente', 'ClienteController')->middleware('permissao');

   
    // prumadas
    Route::resource('prumada', 'PrumadaController', [
        'middleware' => [
            'edit' => 'permissao:administrador,sindico',
            'update' => 'permissao:administrador,sindico',
        ]
    ])->except('show', 'index')->middleware('permissao');


    /* TimeLine */
    
    Route::get('/timeline/equipamento/buscar', 'TimelineController@buscar')->name('Timeline Buscar Equipamento')->middleware('permissao');
    Route::get('/timeline/equipamento', 'TimelineController@index')->name('Timeline Equipamento');
    Route::get('/timeline/equipamento/adicionar', 'TimelineController@create')->name('Adicionar TimeLine Equipamento');
    Route::post('novo-equipamento-timeline', array('uses' => 'TimelineController@store'));
    Route::get('/timeline/equipamento/getEquipamentoLista/{id}', array('uses' => 'TimelineController@showPrumada'));
    Route::post('/timeline/equipamento/getTimelineLista', array('uses' => 'TimelineController@getTimelineLista'));
    
    Route::get('/server/test', 'ServerController@test')->name('Teste de Conexão Servidor')->middleware('permissao');
    Route::post('/server/test', 'ServerController@processTest')->middleware('permissao');

    Route::get('/server/test/local', 'ServerController@localTest')->middleware('permissao');
    Route::post('/server/test/local', 'ServerController@processLocalTest')->middleware('permissao');
    //Route::
    Route::get('importar/csv', 'TesteController@uploadCsv');
    
    /* Relatorios */
    
    Route::get('/relatorio/consumo', 'RelatorioController@relatorioConsumo')->name('Relatorio Consumo');
    Route::post('relatorio/consumo', array('uses' => 'RelatorioController@getConsumoLista'));
    
    //Route::middleware(['permissao:administrador', 'permissao:sindico'])->group(function() {
        Route::get('/relatorio/faturas', 'RelatorioController@relatorioFatura')->name('relatorio.fatura');

        Route::post('relatorio/faturas', array('uses' => 'RelatorioController@getFaturaLista'));

    //});

});


Route::get('criar-duas-prumadas', 'PrumadaController@criarDuas');
Route::any('teste', 'TesteController@teste')->middleware('guest') ;

Route::get('cidades/{estado_id}', function($estado_id) {
    return \App\Models\Cidade::where('estado_id', $estado_id)->pluck('nome', 'id');
});
