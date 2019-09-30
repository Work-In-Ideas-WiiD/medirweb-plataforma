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


    Route::middleware('auth:api')->group(function () {
        Route::group(['prefix' => 'user'], function () {
            Route::post('show', 'UserController@show');
            Route::post('update', 'UserController@update');
        });
    });
});

Route::group(['prefix' => 'unidade'], function() {
    Route::post('/', 'UnidadeController@show');
    Route::post('/imovel', 'UnidadeController@imovel');
    Route::post('/agrupamento', 'UnidadeController@agrupamento');
});


// ### Prumada CONTROLER ###
// Realizar Leitura do Hidrômetro
Route::post('/leitura/prumada', array('uses' => 'Api\PrumadaController@leituraPrumada'));

// Ligar Hidrômetro
Route::post('/ligar/prumada', array('uses' => 'Api\PrumadaController@ligarPrumada'));

// Desligar Hidrômetro
Route::post('/desligar/prumada', array('uses' => 'Api\PrumadaController@desligarPrumada'));

// Ultima Leitura do Hidrômetro
//Route::post('/prumada/ultimaLeitura', array('uses' => 'Api\PrumadaController@ultimaLeitura'));
// fim - ### Prumada CONTROLER ###


// ### Relatorio CONTROLER ###
//Caminho /api/relatorio
Route::group(['prefix' => 'relatorio'], function()
{
    Route::post('/consumo', array('uses' => 'Api\RelatorioController@consumo'));
    Route::post('/fatura', array('uses' => 'Api\RelatorioController@fatura'));
    Route::post('/historicoFaturas', array('uses' => 'Api\RelatorioController@historicoFaturas'));
});
// fim - ### Relatorio CONTROLER ###






// ### CentralResp CONTROLER ###
Route::group(['prefix' => 'central'], function()
{
    Route::get('{ip}/getprumadas/', array('uses' => 'Api\CentralController@getPrumadas'));
    Route::post('addleituras', array('uses' => 'Api\CentralController@addLeituras'));
});
// fim - ### CentralResp CONTROLER ###
