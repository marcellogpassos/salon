<?php

namespace App\Http\Controllers;

use App\Services\BandeirasCartoesServiceInterface;
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

class ComprasController extends Controller {

    protected $bandeirasCartoesService;
    protected $formasPagamentoService;
    protected $itensVendaService;
    protected $usersService;

    public function __construct(UsersServiceInterface $usersService, ItensVendaServiceInterface $itensVendaService,
                                FormasPagamentoServiceInterface $formasPagamentoService,
                                BandeirasCartoesServiceInterface $bandeirasCartoesService) {
        $this->bandeirasCartoesService = $bandeirasCartoesService;
        $this->formasPagamentoService = $formasPagamentoService;
        $this->itensVendaService = $itensVendaService;
        $this->usersService = $usersService;
        $this->middleware('auth');
    }

    public function buscarItem(Request $request) {
        $termo = $request->get('term');
        $query = Config::get('queries.buscarItem');
        $itensEncontrados = DB::select($query, [$termo, $termo, $termo]);
        return response()->json($itensEncontrados);
    }

    public function mostrarFormRegistrarCompra($id) {
        $cliente = $this->usersService->getUser($id);
        $caixa = Auth::user();
        $formasPagamento = $this->formasPagamentoService->listarTodos();
        $bandeirasCartoes = $this->bandeirasCartoesService->listarTodos();
        return view('compras.registrar')
            ->with('cliente', $cliente)
            ->with('caixa', $caixa)
            ->with('formasPagamento', $formasPagamento)
            ->with('bandeirasCartoes', $bandeirasCartoes);
    }

    public function registrarCompra($id, Request $request) {
        $cliente = $this->usersService->getUser($id);
        $caixa = Auth::user();
        $compra['data_compra'] = date('Y-m-d H:i:s');
        $compra['desconto'] = (float) $request->input('desconto');
        $compra['valor_total'] = 0;
        foreach ($request->input('itens') as $item) {
            $item = $this->itensVendaService->getItemVenda($item['id']);
            $compra['valor_total'] += $item->valor;
        }
        return $compra;
        // return $request->all();
    }

} 
