<?php

namespace App\Http\Controllers;

use App\Services\BandeirasCartoesServiceInterface;
use App\Services\ComprasServiceInterface;
use App\Services\FormasPagamentoServiceInterface;
use App\Services\ItensVendaServiceInterface;
use App\Services\UsersServiceInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ComprasController extends Controller {

	protected $bandeirasCartoesService;
	protected $comprasService;
	protected $formasPagamentoService;
	protected $usersService;

	public function __construct(UsersServiceInterface $usersService, ItensVendaServiceInterface $itensVendaService,
								BandeirasCartoesServiceInterface $bandeirasCartoesService,
								FormasPagamentoServiceInterface $formasPagamentoService,
								ComprasServiceInterface $comprasService) {
		$this->bandeirasCartoesService = $bandeirasCartoesService;
		$this->comprasService = $comprasService;
		$this->formasPagamentoService = $formasPagamentoService;
		$this->usersService = $usersService;
		$this->middleware('auth');
		$this->middleware('cashier', ['except' => ['cancelarCompra']]);
		$this->middleware('admin', ['only' => ['cancelarCompra']]);
	}

	// @auth @cashier
	public function buscarItem(Request $request) {
		$termo = $request->get('term');
		$query = Config::get('queries.buscarItem');
		$itensEncontrados = DB::select($query, [$termo, $termo, $termo]);
		return response()->json($itensEncontrados);
	}

	// @auth @cashier
	public function buscarCliente(Request $request) {
		$termo = $request->get('term');
		$query = Config::get('queries.buscarCliente');
		$clientesEncontrados = DB::select($query, [$termo, $termo]);
		return response()->json($clientesEncontrados);
	}

	// @auth @cashier
	public function buscarCompras(Requests\RelatorioCompraRequest $request) {
		if (!count($request->all()))
			return $this->mostrarComprasEncontradas();
		$compras = $this->comprasService->buscar($request->all());
		if ($compras instanceof LengthAwarePaginator)
			return $this->mostrarComprasEncontradas($request->all(), $compras);
		else {
			return isset($compras->codigo_validacao) ?
				Redirect::to('compras/' . $compras->codigo_validacao . '/detalhar') :
				$this->mostrarComprasEncontradas($request->all());
		}
	}

	// @auth @cashier
	public function mostrarComprasEncontradas($buscaPrevia = null, $comprasEncontradas = null) {
		if (!$buscaPrevia)
			return view('compras.listar');
		if (!$comprasEncontradas) {
			showMessage('information', 0);
			return view('compras.listar')
				->with('buscaPrevia', $buscaPrevia);
		}
		return view('compras.listar')
			->with('buscaPrevia', $buscaPrevia)
			->with('comprasEncontradas', $comprasEncontradas);
	}

	// @auth @cashier
	public function mostrarFormRegistrarCompra($id) {
		$cliente = $this->usersService->getUser($id);
		return $this->mostrarFormRegistrarCompraAnonima()
			->with('cliente', $cliente);
	}

	// @auth @cashier
	public function mostrarFormRegistrarCompraAnonima() {
		$caixa = Auth::user();
		$formasPagamento = $this->formasPagamentoService->listarTodos();
		$bandeirasCartoes = $this->bandeirasCartoesService->listarTodos();
		return view('compras.registrar')
			->with('caixa', $caixa)
			->with('formasPagamento', $formasPagamento)
			->with('bandeirasCartoes', $bandeirasCartoes);
	}

	// @auth @cashier
	public function registrarCompra($id, Request $request) {
		$cliente = $id ? $this->usersService->getUser($id) : null;
		$array = $this->comprasService->criarCompra($request->user()->id, $request->all(), $cliente ? $cliente->id : null);
		$compra = $this->comprasService->cadastrar($array);
		showMessage('success', 11, [$compra->codigo_validacao]);
		return Redirect::to('compras/' . $compra->codigo_validacao . '/detalhar');
	}

	// @auth @cashier
	public function registrarCompraAnonima(Request $request) {
		return $this->registrarCompra(null, $request);
	}

	// @auth @cashier
	public function emitirComprovanteCompra($codigoValidacao) {
		$compra = $this->comprasService->getByCodigoValidacao($codigoValidacao);
		return view('compras.comprovante')
			->with('compra', $compra);
	}

	// @auth @cashier
	public function detalharCompra($codigoValidacao) {
		$compra = $this->comprasService->getByCodigoValidacao($codigoValidacao);
		return view('compras.detalhar')
			->with('compra', $compra);
	}

	// @auth @admin
	public function cancelarCompra($codigoValidacao, Request $request) {
		$compra = $this->comprasService->getByCodigoValidacao($codigoValidacao);
		$result = $this->comprasService->cancelarCompra($compra);
		if ($result)
			showMessage('success', 20);
		else
			showMessage('error', 17);
		return back();
	}

}
