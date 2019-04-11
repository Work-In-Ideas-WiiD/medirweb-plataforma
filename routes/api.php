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




//Caminho /api/login
Route::group(['prefix' => 'login'], function()
{
    //Caminho /api/login
    Route::post('', ['uses' => 'Api\UserController@login']);

    //Caminho /api/login/esqueciSenha
    Route::post('esqueciSenha', ['uses' => 'Api\UserController@esqueciSenha']);
});


//Caminho /api/user
Route::group(['prefix' => 'user'], function()
{
    //Caminho /api/user/show
    Route::group(['prefix' => 'show'], function()
    {
        Route::post('', ['uses' => 'Api\UserController@showUsers']);
    });

    //Caminho /api/user/update
    Route::group(['prefix' => 'update'], function()
    {
        Route::post('', ['uses' => 'Api\UserController@updateUsers']);
    });

});


// ### UNIDADE CONTROLER ###
//Caminho /api/unidade
Route::group(['prefix' => 'unidade'], function()
{
    //Caminho /api/unidade/ver
    Route::group(['prefix' => 'ver'], function()
    {
        Route::post('/imovel', ['uses' => 'Api\UnidadeController@showImovel']);
        Route::post('/agrupamento', ['uses' => 'Api\UnidadeController@showAgrupamento']);
        Route::post('/unidade', ['uses' => 'Api\UnidadeController@showUnidade']);
        //Route::post('/prumadas', ['uses' => 'Api\UnidadeController@showPrumadas']);
    });
});
// fim - ### UNIDADE CONTROLER ####


// ### Prumada CONTROLER ###
// Realizar Leitura do Hidrômetro
Route::post('/leitura/prumada', array('uses' => 'Api\PrumadaController@leituraPrumada'));

// Ligar Hidrômetro
//Route::post('/ligar/prumada/{prumada}', array('uses' => 'Api\PrumadaController@ligarPrumada'));

// Desligar Hidrômetro
//Route::post('/desligar/prumada/{prumada}', array('uses' => 'Api\PrumadaController@desligarPrumada'));

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
});
// fim - ### CentralResp CONTROLER ###
