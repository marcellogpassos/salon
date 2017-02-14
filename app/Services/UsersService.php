<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 15/06/2016
 * Time: 22:04
 */

namespace App\Services;


use App\Agendamento;
use App\Repositories\Criteria\User\BuscarPorCPF;
use App\Repositories\Criteria\User\BuscarPorEmail;
use App\Repositories\Criteria\User\BuscarPorNomeSobrenome;
use App\Repositories\Criteria\User\BuscarPorSexo;
use App\Repositories\Criteria\User\BuscarPorTelefone;
use App\Repositories\Criteria\User\OrdenarPorNomeSobrenome;
use App\Repositories\UsersRepository as Users;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersService implements UsersServiceInterface {

	protected $users;

	public function __construct(Users $repository) {
		$this->users = $repository;
	}

	public function buscar($criterios) {
		if (filtroFornecido($criterios, 'email'))
			$this->users->pushCriteria(new BuscarPorEmail($criterios['email']));
		else if (filtroFornecido($criterios, 'cpf', 11))
			$this->users->pushCriteria(new BuscarPorCPF($criterios['cpf']));
		else if (filtroFornecido($criterios, 'id'))
			return $this->users->findWhere(['id' => $criterios['id']], true);
		else {
			if (filtroFornecido($criterios, 'nome_sobrenome'))
				$this->users->pushCriteria(new BuscarPorNomeSobrenome($criterios['nome_sobrenome']));
			if (filtroFornecido($criterios, 'sexo'))
				$this->users->pushCriteria(new BuscarPorSexo($criterios['sexo']));
			if (filtroFornecido($criterios, 'telefone'))
				$this->users->pushCriteria(new BuscarPorTelefone($criterios['telefone']));
		}
		return $this->users->pushCriteria(new OrdenarPorNomeSobrenome())->paginate();
	}

	public function atualizarDados($id, array $attributes) {
		$attributes = array_add($attributes, 'dados_atualizados', '1');
		return $this->users->updateRich($attributes, $id);
	}

	public function salvarFoto($foto) {
		$dirName = $this->getDirName();
		$fileName = $this->getFileName($foto->getClientOriginalExtension());
		$file = $foto->move($dirName, $fileName);
		$filePath = $file->getPath() . '/' . $file->getFilename();
		return $filePath;
	}

	public function deletarFoto($filename) {
		File::delete($filename);
	}

	public function atualizarFoto($user, $foto) {
		$fotoAnterior = $user->foto;

		$filename = $this->salvarFoto($foto);
		$user->foto = $filename;
		$user->save();

		if ($fotoAnterior)
			$this->deletarFoto($fotoAnterior);

		return $user;
	}

	public function apagarFoto($user) {
		$fotoAnterior = $user->foto;

		$user->foto = null;
		$user->save();

		if ($fotoAnterior)
			$this->deletarFoto($fotoAnterior);

		return $user;
	}

	private function getDirName() {
		return env('USER_FOTO_BASE_DIR') . md5(time() % 97);
	}

	private function getFileName($extension) {
		return md5(uniqid(rand(), true)) . '.' . $extension;
	}

	public function getUser($id) {
		return $this->users->find($id);
	}

	public function sincronizarPapeis($userId, array $roles) {
		return $this->users->sincronizarPapeis($userId, $roles);
	}

	public function atualizarCurriculo($userId, $curriculo) {
		return $this->users->update(['curriculo' => $curriculo], $userId);
	}

	public function listarFuncionarios() {
		return $this->users->listarFuncionarios();
	}

	public function setStatusUsuario($user, $ativo) {
		return $this->users->update(['ativo' => $ativo], $user->id);
	}

	public function getInteressadosAgendamento(Agendamento $agendamento) {
		$interessados = DB::table('users')
			->select('users.*')
			->join('role_user', 'users.id', '=', 'role_user.user_id')
			->where('role_user.role_id', Role::ADMIN);
		$profissional = null;
		if (isset($agendamento->profissional))
			$profissional = DB::table('users')
				->select('users.*')
				->where('users.id', $agendamento->profissional->id);
		if ($profissional)
			$interessados->union($profissional);
		return User::hydrate($interessados->get());
	}

	public function getAdministradores() {
		$administradores = DB::table('users')
			->select('users.*')
			->join('role_user', 'users.id', '=', 'role_user.user_id')
			->where('role_user.role_id', Role::ADMIN);
		return User::hydrate($administradores->get());
	}

	public function excluirUsuario($user) {
		return $this->users->delete($user->id);
	}

	public function getUsersEmail($users) {
		$emails = [];
		if ($users)
			foreach ($users as $user)
				array_push($emails, $user->email);
		return $emails;
	}

	public function alterarSenha($user, $novaSenha) {
		$senhaCript = bcrypt($novaSenha);
		return $this->users->update(['password' => $senhaCript], $user->id);
	}

	public function validarSenha($userId, $senha) {
		$user = $this->users->find($userId);
		return Hash::check($senha, $user->password);
	}

	public function cadastrarCliente($dados) {
		$user = $this->users->create($dados);
		if ($user->email) {
			$password = $this->gerarSenha($user);
			$this->users->update(['password' => $password], $user->id);

			$this->notificarCliente($user, getMessage('success', 21), 'emails.cadastrarUsuario.cadastro');
		}
		return $user;
	}

	private function notificarCliente(User $user, $subject, $view) {
		Mail::send($view,
			['user' => $user],
			function ($message) use ($user, $subject) {
				return $message
					->to($user->email)
					->subject($subject);
			}
		);
	}

	private function gerarSenha($user) {
		$dataNascimento = Carbon::createFromFormat('Y-m-d', $user->data_nascimento);
		$ano = str_pad($dataNascimento->year % 100, 2, "0", STR_PAD_LEFT);
		$mes = str_pad($dataNascimento->month, 2, "0", STR_PAD_LEFT);
		$dia = str_pad($dataNascimento->day, 2, "0", STR_PAD_LEFT);
		$plainPassword = $dia . $mes . $ano;
		return bcrypt($plainPassword);
	}

}