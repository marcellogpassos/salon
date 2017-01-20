<?php
/**
 * Created by PhpStorm.
 * User: 08417523464
 * Date: 20/01/2017
 * Time: 13:07
 */

namespace App\Services;


use App\Repositories\ContasExcluidasRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContasExcluidasService implements ContasExcluidasServiceInterface {

    protected $repository;

    protected $usersService;

    public function __construct(ContasExcluidasRepository $repository, UsersServiceInterface $usersService) {
        $this->repository = $repository;
        $this->usersService = $usersService;
    }

    public function cadastrarContaExcluida($user, $motivo, $stars) {
        $contaExcluida = $this->repository->create([
            'email' => $user->email,
            'telefone' => $user->telefone,
            'motivo' => $motivo,
            'stars' => $stars,
        ]);

        if($contaExcluida->id) {
            try {
                $this->notificarAdministradores($user, $contaExcluida);
                if ($user->email)
                    $this->notificarCliente($user, $contaExcluida);
            } catch (\Exception $ex) {
                Log::error('Envio de email falhou!');
            }
        }

        return $contaExcluida;
    }

    private function notificarAdministradores($user, $contaExcluida) {
        $subject = getMessage('information', 4, [$user->name . ' ' . $user->surname]);
        $view = 'emails.contasExcluidas.administradores';
        $administradores = $this->usersService->getAdministradores();
        $emails = $this->usersService->getUsersEmail($administradores);
        Mail::send($view,
            ['user' => $user, 'contaExcluida' => $contaExcluida],
            function ($message) use ($emails, $subject) {
                return $message
                    ->to($emails)
                    ->subject($subject);
            }
        );
    }

    private function notificarCliente($user, $contaExcluida) {
        $subject = getMessage('information', 5);
        $view = 'emails.contasExcluidas.cliente';
        $email = $user->email;
        Mail::send($view,
            ['user' => $user, 'contaExcluida' => $contaExcluida],
            function ($message) use ($email, $subject) {
                return $message
                    ->to($email)
                    ->subject($subject);
            }
        );
    }

}