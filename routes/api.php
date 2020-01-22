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

Route::namespace('Api')->group(function () {
    Route::post('login', 'UserController@login');
    Route::post('forgot', 'UserController@forgot');
});


Route::middleware('auth:api')->namespace('Api')->group(function () {

    //inicio usuário
    Route::group(['prefix' => 'user'], function () {
        Route::post('show', 'UserController@show');
        Route::post('update', 'UserController@update');
    });
    //fim usuario


    //inicio unidade
    Route::group(['prefix' => 'unidade'], function () {
        Route::post('/', 'UnidadeController@show');
        Route::post('/imovel', 'UnidadeController@imovel');
        Route::post('/agrupamento', 'UnidadeController@agrupamento');
    });
    //fim unidade


    //inicio prumada
    Route::group(['prefix' => 'prumada'], function () {
        Route::post('leitura', 'PrumadaController@leitura');
        Route::post('{comando}', 'PrumadaController@ligarDesligar');
    });

    // Ultima Leitura do Hidrômetro
    // Route::post('/prumada/ultimaLeitura', array('uses' => 'Api\PrumadaController@ultimaLeitura'));
    // fim - ### Prumada CONTROLER ###


    //inicio relatorio
    Route::group(['prefix' => 'relatorio'], function () {
        Route::post('consumo', 'RelatorioController@consumo');
    });
    //fim relatorio

    // ### Relatorio CONTROLER ###

    //Caminho /api/relatorio
    Route::group(['prefix' => 'relatorio'], function() {
        Route::post('fatura', 'RelatorioController@fatura');
        Route::post('historico-fatura', 'RelatorioController@historicoFaturas');
    });
    // fim - ### Relatorio CONTROLER ###
});











// ### CentralResp CONTROLER ###
Route::group(['prefix' => 'central', 'namespace' => 'Api'], function()
{
    Route::get('{ip}/getprumadas/', 'CentralController@getPrumadas');
    Route::get('{ip}/getprumadas/{id}', 'CentralController@getPrumadas');
    Route::post('addleituras', 'CentralController@addLeituras');
    Route::get('{ip}/sicronizar/leituras', 'CentralController@sicronizarLeituras');
    Route::get('{ip}/sicronizar/falhas', 'CentralController@sicronizarFalhas');
    Route::any('{imovel}/prumadas/falhas', 'CentralController@prumadasFalhas');
    Route::any('media/consumo', 'CentralController@imovelMediaConsumo');
});
// fim - ### CentralResp CONTROLER ###
