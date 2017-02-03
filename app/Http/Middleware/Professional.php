<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Professional {

    public function handle($request, Closure $next) {
        $user = Auth::user();

        if (count($user->roles))
            return $next($request);

        showMessage('error', 19);
        return redirect('/');
    }

}
