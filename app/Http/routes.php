<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('marcas/listar', 'MarcasProdutosController@mostrarListaMarcasProdutos');

Route::get('users/buscar', 'UsersController@mostrarFormBuscarUsuarios');
Route::post('users/buscar', 'UsersController@mostrarUsuariosEncontrados');
Route::get('users/dados', 'UsersController@mostrarFormEditarDadosUsuario');
Route::post('users/dados', 'UsersController@editarDadosUsuario');
Route::get('users/{id}/papeis', 'UsersController@mostrarFormGerenciarPapeis');
Route::post('users/{id}/papeis', 'UsersController@editarPapeis');
Route::get('users/{id}', 'UsersController@recuperarUsuario');
