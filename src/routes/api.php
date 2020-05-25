<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'admin'], function(){
    // Usuários
    Route::apiResource('usuarios', 'admin\UsuariosController');
        Route::delete('usuarios/{usuario}/permanente', 'admin\UsuariosController@permanentDestroy');
        Route::delete('usuarios/{usuario}/restore', 'admin\UsuariosController@restore');

    // Categorias 
    Route::apiResource('categorias', 'admin\CategoriasController'); 
        Route::delete('categorias/{categoria}/permanente', 'admin\CategoriasController@permanentDestroy');
        Route::delete('categorias/{categoria}/restore', 'admin\CategoriasController@restore');
    
});

Route::post('registro-usuario', 'AuthController@registroUsuario');

Route::post('login', 'AuthController@login');

Route::get('logout', 'AuthController@logout');
Route::get('user', 'AuthController@getAuthUser');

Route::post('criareset', 'AuthController@reset');


//Usuários
Route::get('usuarios', 'UserController@index');
Route::get('usuarios/{usuario}', 'UserController@show');
Route::post('usuarios/{usuario}', 'UserController@update');
Route::get('usuarios/{usuario}/delete', 'UserController@destroy');
Route::post('usuarios/{usuario}/profilepic', "UserController@profilepic");


//Categorias
Route::get('categorias', 'CategoriasController@index');
Route::get('categorias/{categoria}', 'CategoriasController@show');
Route::post('categorias/{categoria}', 'CategoriasController@update');
Route::post('categorias','CategoriasController@store');
Route::get('categorias/{categoria}/delete', 'CategoriasController@destroy');
