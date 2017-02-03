<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class Cashier {

    public function handle($request, Closure $next) {
        $user = Auth::user();

        if ($user->possuiRole(Role::CAIXA) || $user->admin())
            return $next($request);

        showMessage('error', 19);
        return redirect('/');
    }
}
