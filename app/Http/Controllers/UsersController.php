<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersBuscarRequest;
use App\Http\Requests\UsersStatusRequest;
use App\Municipio;
use App\Services\ContasExcluidasServiceInterface;
use App\Services\RolesServiceInterface;
use App\Services\UsersServiceInterface;
use App\Http\Requests\UsersDadosRequest;
use App\Uf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {

    protected $usersService;
    protected $rolesService;
    protected $contasExcluidasService;

    public function __construct(UsersServiceInterface $usersService, RolesServiceInterface $rolesService,
                                ContasExcluidasServiceInterface $contasExcluidasService) {
        $this->usersService = $usersService;
        $this->rolesService = $rolesService;
        $this->contasExcluidasService = $contasExcluidasService;
        $this->middleware('auth');
    }

    public function mostrarFormBuscarUsuarios(Request $request) {
        $userId = $request->input('user');
        return view('users.buscar');
    }

    public function mostrarUsuariosEncontrados(UsersBuscarRequest $request) {
        if (!count($request->all()))
            return view('users.buscar');
        $usersEncontrados = $this->usersService->buscar($request->all());
        return view('users.buscar')
            ->with('usersEncontrados', $usersEncontrados)
            ->with('buscaPrevia', $request->all());
    }

    public function mostrarFormEditarDadosUsuario() {
        $user = Auth::user();
        $ufs = Uf::all();
        $municipios = isset($user->municipio) ? Municipio::where('uf_id', $user->municipio->uf_id)->get() : null;
        return view('users.dados')
            ->with('user', $user)
            ->with('ufs', $ufs)
            ->with('municipios', $municipios);
    }

    public function mostrarFormGerenciarPapeis($id) {
        $user = $this->usersService->getUser($id);
        $roles = $this->rolesService->listarTodos();
        return view('users.roles')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    public function editarDadosUsuario(UsersDadosRequest $request) {
        $user = Auth::user();
        $sucesso = $this->usersService->atualizarDados($user->id, $request->all());
        if (!$request->hasFile('foto') && $request->has('foto_anterior'))
            $this->usersService->apagarFoto($user);
        if ($request->hasFile('foto') && $request->file('foto')->isValid())
            $this->usersService->atualizarFoto($user, $request->file('foto'));
        if ($sucesso)
            showMessage('success', 0);
        else
            showMessage('error', 3);
        return redirect('home');
    }

    public function editarPapeis($id, Request $request) {
        $this->usersService->sincronizarPapeis($id, $request->input('roles'));
        $this->usersService->atualizarCurriculo($id, $request->has('curriculo') ? $request->input('curriculo') : null);
        showMessage('success', 1);
        return $this->mostrarFormGerenciarPapeis($id);
    }

    public function recuperarUsuario($id) {
        $user = $this->usersService->getUser($id);
        $municipio = $user->municipio;
        if ($municipio)
            $uf = $user->municipio->uf;
        return response()->json($user);
    }

    public function status(UsersStatusRequest $request) {
        $user = $this->usersService->getUser($request->input('id'));
        $ativo = $request->input('ativo');
        $result = $this->usersService->setStatusUsuario($user, $ativo);

        if ($result)
            showMessage('success', ($ativo) ? 16 : 17, [$user->name . ' ' . $user->surname]);
        else
            showMessage('error', ($ativo) ? 12 : 13);

        return redirect('/users/buscar?id=' . $user->id);
    }

    public function mostrarFormExcluirConta() {
        $user = Auth::user();
        return view('users.excluirConta')
            ->with('user', $user);
    }

    public function excluirConta(Request $request) {
        $user = Auth::user();
        if (!$this->usersService->validarSenha($user->id, $request->input('password'))) {
            showMessage('error', 15);
            return back()->withInput();
        } else {
            $this->contasExcluidasService->cadastrarContaExcluida($user, $request->motivo, $request->stars);
            $this->usersService->excluirUsuario($user);
            return redirect('/logout');
        }
    }

    public function mostrarFormAlterarSenha() {
        $user = Auth::user();
        return view('users.alterarSenha')
            ->with('user', $user);
    }

    public function alterarSenha(Request $request) {
        $this->validate($request, [
            'new-password' => 'min:6|max:32|required',
            'confirm-new-password' => 'same:new-password',
        ]);

        $user = Auth::user();

        if(!$this->usersService->validarSenha($user->id, $request->input('current-password'))){
            showMessage('error', 15);
            return back();
        } else {
            if( $this->usersService->alterarSenha($user, $request->input('new-password')) ) {
                showMessage('success', 19);
                return redirect('/home');
            } else {
                showMessage('error', 16);
                return back();
            }
        }

    }

    public function mostrarFormCadastrarUsuario() {
        $ufs = Uf::all();
        return view('users.cadastrar')
            ->with('ufs', $ufs);
    }

}
