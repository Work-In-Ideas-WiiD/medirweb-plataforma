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


// ### UNIDADE ###

// Leitura do Hidrômetro
Route::get('/imovel/{imovel}/unidade/{unidade}', array('uses' => 'Api\UnidadeController@leituraUnidade'));

//Caminho /api/unidade
/*Route::group(['prefix' => 'unidade'], function()
{

    //Caminho /api/unidade/{imovel}/leitura/{unidade}
    Route::group(['prefix' => '{imovel}/leitura/{unidade}'], function()
    {
        Route::post('', ['uses' => 'Api\UnidadeController@leituraUnidade']);
    });

});
*/
