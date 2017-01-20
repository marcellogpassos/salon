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


Route::get('/', 'WelcomeController@welcome');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/teste', function () {
	return null;
});

Route::get('agenda/', 'AgendamentosController@minhaAgenda');
Route::get('agendamentos/pendentes', 'AgendamentosController@agendamentosPendentes');
Route::get('agendamentos/{id}', 'AgendamentosController@recuperarAgendamento');
Route::get('agendamentos/', 'AgendamentosController@index');
Route::post('agendamentos/analisar', 'AgendamentosController@analisar');
Route::post('agendamentos/', 'AgendamentosController@agendar');
Route::delete('agendamentos/{id}', 'AgendamentosController@cancelarAgendamento');

Route::get('categoriasServicos/{id}/servicos', 'ServicosController@listarServicosPorCategoria');

Route::get('compras/buscarItem', 'ComprasController@buscarItem');
Route::get('compras/buscarCliente', 'ComprasController@buscarCliente');
Route::get('compras/buscar', 'ComprasController@buscarCompras');
Route::get('compras/registrar', 'ComprasController@mostrarFormRegistrarCompraAnonima');
Route::post('compras/registrar', 'ComprasController@registrarCompraAnonima');
Route::get('compras/{codigoValidacao}/detalhar', 'ComprasController@detalharCompra');
Route::get('compras/{codigoValidacao}/emitirComprovante', 'ComprasController@emitirComprovanteCompra');

Route::get('marcas/cadastrar', 'MarcasProdutosController@mostrarFormCadastrarMarcaProduto');
Route::post('marcas/cadastrar', 'MarcasProdutosController@cadastrarMarcaProduto');
Route::get('marcas/{id}/editar', 'MarcasProdutosController@mostrarFormEditarMarcaProduto');
Route::post('marcas/{id}/editar', 'MarcasProdutosController@editarMarcaProduto');
Route::get('marcas/{id}/excluir', 'MarcasProdutosController@excluirMarcaProduto');
Route::get('marcas', 'MarcasProdutosController@mostrarListaMarcasProdutos');

Route::get('produtos/buscar', 'ProdutosController@mostrarProdutosEncontrados');
Route::get('produtos/cadastrar', 'ProdutosController@mostrarFormCadastrarProduto');
Route::post('produtos/cadastrar', 'ProdutosController@cadastrarProduto');
Route::get('produtos/{id}/editar', 'ProdutosController@mostrarFormEditarProduto');
Route::post('produtos/{id}/editar', 'ProdutosController@editarProduto');
Route::get('produtos/{id}/excluir', 'ProdutosController@excluirProduto');

Route::get('servicos/buscar', 'ServicosController@mostrarServicosEncontrados');
Route::get('servicos/cadastrar', 'ServicosController@mostrarFormCadastrarServico');
Route::post('servicos/cadastrar', 'ServicosController@cadastrarServico');
Route::get('servicos/{id}/editar', 'ServicosController@mostrarFormEditarServico');
Route::post('servicos/{id}/editar', 'ServicosController@editarServico');
Route::get('servicos/{id}/excluir', 'ServicosController@excluirServico');
Route::get('servicos/{id}/profissionais', 'ServicosController@listarProfissionaisPorServico');

Route::post('users/status', 'UsersController@status');
Route::get('users/buscar', 'UsersController@mostrarUsuariosEncontrados');
Route::get('users/dados', 'UsersController@mostrarFormEditarDadosUsuario');
Route::post('users/dados', 'UsersController@editarDadosUsuario');
Route::get('users/excluirConta', 'UsersController@mostrarFormExcluirConta');
Route::post('users/excluirConta', 'UsersController@excluirConta');
Route::get('users/{id}/agendar', 'AgendamentosController@mostrarFormAgendarParaCliente');
Route::post('users/{id}/agendar', 'AgendamentosController@agendarParaCliente');
Route::get('users/{id}/papeis', 'UsersController@mostrarFormGerenciarPapeis');
Route::post('users/{id}/papeis', 'UsersController@editarPapeis');
Route::get('users/{id}/registrarCompra', 'ComprasController@mostrarFormRegistrarCompra');
Route::post('users/{id}/registrarCompra', 'ComprasController@registrarCompra');
Route::get('users/{id}', 'UsersController@recuperarUsuario');

Route::get('estatisticas/', 'EstatisticasController@mostrarEstatisticas');

Route::get('ufs/{uf}/municipios', 'EnderecosController@listarMunicipios');
Route::get('municipios/{municipio}', 'EnderecosController@getMunicipio');

Route::post('mensagens/', 'MensagensController@enviarMensagem');