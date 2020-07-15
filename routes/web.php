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
    
    Route::get('/home', 'HomeController@index')->name('home')->middleware('permissao:administrador|sindico|secretario');
    
    Route::post('importar/csv', 'TesteController@process')->middleware('permissao:administrador|sindico');
    
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
    Route::prefix('imovel')->middleware('permissao:administrador|sindico')->group(function () {
        Route::get('buscar', 'ImovelController@buscar');
        Route::get('buscar/ver/{imovel}', 'ImovelController@show_buscar');
        Route::get('/lista/{cidade}', 'ImovelController@lista');
        
    });

    Route::get('imovel/{imovel}/unidade', 'ImovelController@unidade');
    Route::get('imovel/{imovel}/agrupamento', 'ImovelController@agrupamento');
    Route::resource('/imovel', 'ImovelController', [
        'middleware' => [
            'index' => 'permissao:administrador|sindico',
            'create' => 'permissao',
            'store' => 'permissao',
            'view' => 'permissao:administrador|sindico',
            'edit' => 'permissao:administrador|sindico',
            'update' => 'permissao:administrador|sindico',
            'destroy' => 'permissao'
        ]
    ]);
    

    Route::get('/imovel/{imovel}/consumo', 'ImovelController@getLancarConsumo')->name('imovel.consumo')
        ->middleware('permissao:administrador|sindico');
    
    Route::post('lancar-consumo', 'ImovelController@postLancarConsumo');

    
    /* imóveis */
    Route::get('/leitura/prumada/{prumada}', 'ImovelController@leituraUnidade');
    
    Route::get('/imovel/{prumada}/{comando}','ImovelController@ligarDesligarPrumada')->middleware('permissao');
    
    
    /* Agrupamentos */

    Route::get('agrupamento/unidade/{agrupamento}', 'AgrupamentoController@unidade');
    Route::resource('agrupamento', 'AgrupamentoController', [
        'middleware' => [
            'create' => 'permissao',
            'store' => 'permissao',
            'view' => 'permissao',
            'edit' => 'permissao:administrador|sindico',
            'update' => 'permissao:administrador|sindico',
            'destroy' => 'permissao'
        ]
    ])->except(['index', 'show']);
    /* Unidades */

    
    Route::resource('unidade', 'UnidadeController', [
        'middleware' => [
            'create' => 'permissao',
            'store' => 'permissao',
            'view' => 'permissao',
            'edit' => 'permissao:administrador|sindico',
            'update' => 'permissao:administrador|sindico',
            'destroy' => 'permissao'
        ]
    ]);


    //Unidade_User
    Route::get('usuario/{unidade}/unidade', 'UserController@unidade')
        ->name('usuario.unidade')->middleware('permissao');
    Route::post('usuario/{unidade}/unidade/store', 'UserController@unidadeStore')
        ->name('usuario.unidade.store')->middleware('permissao');
    
    
    Route::prefix('unidade')->group(function () {
        Route::get('/update/{unidade}/user/{user}', 'UnidadeController@edit_user')
            ->name('unidade.edit_user')->middleware('permissao');

        Route::put('/update/{unidade}/user/{user}', 'UnidadeController@update_user')
            ->name('unidade.update_user')->middleware('permissao');

        //Unidade_User_Existente
        Route::get('/{unidade}/user/existente', 'UnidadeController@add_user_existente')
            ->name('unidade.add_user_existente')->middleware('permissao');
        Route::post('/{unidade}/user/existente', 'UnidadeController@store_user_existente')
            ->middleware('permissao');
    });
    
    
    // Desvincular usuario à unidade
    Route::delete('/unidade/desvincular/{user}', 'UnidadeController@desvincular_user')
        ->name('unidade.desvincular_user')->middleware('permissao');
    

    // clientes 
    Route::resource('cliente', 'ClienteController')->middleware('permissao');

   
    // prumadas
    Route::resource('prumada', 'PrumadaController', [
        'middleware' => [
            'edit' => 'permissao:administrador|sindico',
            'update' => 'permissao:administrador|sindico',
        ]
    ])->except('show', 'index')->middleware('permissao');


    /* TimeLine */
    
    Route::get('/timeline/equipamento/buscar', 'TimelineController@buscar')->name('Timeline Buscar Equipamento')->middleware('permissao');
    Route::get('/timeline/equipamento', 'TimelineController@index')->name('Timeline Equipamento');
    Route::get('/timeline/equipamento/adicionar', 'TimelineController@create')->name('Adicionar TimeLine Equipamento');
    Route::post('novo-equipamento-timeline', 'TimelineController@store');
    Route::get('/timeline/equipamento/getEquipamentoLista/{id}', 'TimelineController@showPrumada');
    Route::post('/timeline/equipamento/getTimelineLista', 'TimelineController@getTimelineLista');
    
    Route::get('/server/test', 'ServerController@test')->name('Teste de Conexão Servidor')->middleware('permissao');
    Route::post('/server/test', 'ServerController@processTest')->middleware('permissao');

    Route::get('/server/test/local', 'ServerController@localTest')->middleware('permissao');
    Route::post('/server/test/local', 'ServerController@processLocalTest')->middleware('permissao');

    Route::get('/server/comandos', 'ServerController@comandos')->middleware('permissao');
    Route::post('/server/comandos', 'ServerController@comandosPost')->middleware('permissao');
    //Route::
    Route::get('importar/csv', 'TesteController@uploadCsv');
    
    /* Relatorios */
    
    Route::get('/relatorio/consumo', 'RelatorioController@relatorioConsumo')->name('Relatorio Consumo');
    Route::post('relatorio/consumo', 'RelatorioController@getConsumoLista');

    Route::get('/relatorio/faturas', 'RelatorioController@relatorioFatura')->name('relatorio.fatura');
    Route::post('relatorio/faturas', 'RelatorioController@getFaturaLista');
    
    Route::match(['get', 'post'], 'relatorio/falha', 'FalhaController@index');

    Route::group(['prefix' => 'sindico'], function() {
        Route::get('busca', 'SindicoController@busca');
        Route::get('painel', 'SindicoController@painel');
        Route::get('unidade', 'SindicoController@unidade');
        Route::get('unidade/dados', 'SindicoController@dadosUnidade');
        Route::get('unidade/grafico-consumo-anual/{bloco}', 'SindicoController@graficoConsumoAnual');
        Route::get('consumo-por-bloco-e-unidade/{bloco}/{primeiro_mes}/{ultimo_mes}', 'SindicoController@consumoPorBlocoEUnidade');
        Route::get('consumo-por-bloco-e-unidade/{bloco}/diario', 'SindicoController@consumoPorBlocoEUnidadeDiario');
        
        Route::group(['prefix' => 'relatorio'], function() {
            Route::get('consumo-por-unidade', 'SindicoController@consumoPorUnidade');
            Route::get('lista-de-leitura', 'SindicoController@listaDeLeitura');
            Route::get('lista-de-leitura/tabela', 'SindicoController@listaDeLeituraTabela');
            Route::get('unidade-por-bloco/{bloco}', 'SindicoController@unidadePorBloco');
            Route::get('comparativo-de-consumo', 'SindicoController@comparativoDeConsumo');
            Route::get('comparativo-de-consumo-mensal', 'SindicoController@comparativoDeConsumoMensal');
        });

        //EXPORT TABLES DOWNLOAD 
        Route::group(['prefix' => 'export'], function() {
            Route::get('consumo-ultimo-seis-meses', 'SindicoController@exportUltimosPorBlocoSeisMeses');
            Route::get('consumo-grafico', 'SindicoController@exportGraficoCosumo');
            
        });
        
    });
});


Route::get('criar-duas-prumadas', 'PrumadaController@criarDuas');
Route::any('teste', 'TesteController@teste')->middleware('guest') ;

Route::get('cidades/{estado_id}', function ($estado_id) {
    return \App\Models\Cidade::where('estado_id', $estado_id)->pluck('nome', 'id');
});


Route::get('downloads/central-medirweb', function () {
    return response()->download(storage_path('app/downloads/central-medirweb.zip'));
});


Route::get('felicitta', 'TesteController@felicittaAtualizarEquipamentos');
Route::get('felicitta_senha', 'TesteController@felicittaLogins');

Route::get('felicitta_ajuste', 'TesteController@exportJson');

Route::get('teste_data', 'TesteController@teste');


Route::get('teste_relatorio', 'TesteController@teste_relatorio');

Route::get('relatorio_fatura_unidade', 'TesteController@relatorio_fatura_unidade');

Route::get('felicitta_moradores', 'TesteController@felicitta_moradores');

Route::get('felicitta_corrigir_repetidor', 'TesteController@felicitta_corrigir_repetidor');


Route::get('equipamentos', 'TesteController@felicitta_equipamentos');


Route::get('alterar_medidor', 'TesteController@alterar_medidor');