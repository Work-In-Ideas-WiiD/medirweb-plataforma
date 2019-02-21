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
    Route::post('', ['uses' => 'Api\UserController@login']);
});


//Caminho /api/user
Route::group(['prefix' => 'user'], function()
{
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

    //Caminho /api/unidade/ver/{id}
    Route::group(['prefix' => 'ver/{id}'], function()
    {
        Route::get('/imovel', ['uses' => 'Api\UnidadeController@showImovel']);
        Route::get('/agrupamento', ['uses' => 'Api\UnidadeController@showAgrupamento']);
        Route::get('/unidade', ['uses' => 'Api\UnidadeController@showUnidade']);
        Route::get('/prumadas', ['uses' => 'Api\UnidadeController@showPrumadas']);
    });

});
// fim - ### UNIDADE CONTROLER ####


// ### Prumada CONTROLER ###
// Realizar Leitura do Hidrômetro
Route::get('/leitura/prumada/{prumada}', array('uses' => 'Api\PrumadaController@leituraPrumada'));

// Ligar Hidrômetro
Route::get('/ligar/prumada/{prumada}', array('uses' => 'Api\PrumadaController@ligarPrumada'));

// Desligar Hidrômetro
Route::get('/desligar/prumada/{prumada}', array('uses' => 'Api\PrumadaController@desligarPrumada'));

// Ultima Leitura do Hidrômetro
Route::get('/prumada/{prumada}/ultimaLeitura', array('uses' => 'Api\PrumadaController@ultimaLeitura'));
// fim - ### Prumada CONTROLER ###
