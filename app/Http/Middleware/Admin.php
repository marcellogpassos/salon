<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin {

    public function handle($request, Closure $next) {
        $user = Auth::user();

        if ($user->admin())
            return $next($request);

        showMessage('error', 19);
        return redirect('/');
    }

}
