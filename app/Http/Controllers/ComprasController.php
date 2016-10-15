<?php

namespace App\Http\Controllers;

use App\Services\BandeirasCartoesServiceInterface;
use App\Services\ComprasServiceInterface;
use App\Services\FormasPagamentoServiceInterface;
use App\Services\ItensVendaServiceInterface;
use App\Services\UsersServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
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
	}

	public function buscarItem(Request $request) {
		$termo = $request->get('term');
		$query = Config::get('queries.buscarItem');
		$itensEncontrados = DB::select($query, [$termo, $termo, $termo]);
		return response()->json($itensEncontrados);
	}

	public function mostrarComprasEncontradas() {
		return view('compras.listar');
	}

	public function mostrarFormRegistrarCompra($id) {
		$cliente = $this->usersService->getUser($id);
		return $this->mostrarFormRegistrarCompraAnonima()
			->with('cliente', $cliente);
	}

	public function mostrarFormRegistrarCompraAnonima() {
		$caixa = Auth::user();
		$formasPagamento = $this->formasPagamentoService->listarTodos();
		$bandeirasCartoes = $this->bandeirasCartoesService->listarTodos();
		return view('compras.registrar')
			->with('caixa', $caixa)
			->with('formasPagamento', $formasPagamento)
			->with('bandeirasCartoes', $bandeirasCartoes);
	}

	public function registrarCompra($id, Request $request) {
		$cliente = $id ? $this->usersService->getUser($id) : null;
		$array = $this->comprasService->criarCompra($request->user()->id, $request->all(), $cliente ? $cliente->id : null);
		$compra = $this->comprasService->cadastrar($array);
		showMessage('success', 11, [$compra->codigo_validacao]);
		return Redirect::to('compras/' . $compra->codigo_validacao . '/detalhar');
	}

	public function registrarCompraAnonima(Request $request) {
		return $this->registrarCompra(null, $request);
	}

	public function emitirComprovanteCompra($codigoValidacao) {
		$compra = $this->comprasService->getByCodigoValidacao($codigoValidacao);
		return view('compras.comprovante')
			->with('compra', $compra);
	}

	public function detalharCompra($codigoValidacao) {
		$compra = $this->comprasService->getByCodigoValidacao($codigoValidacao);
		return view('compras.detalhar')
			->with('compra', $compra);
	}

}
