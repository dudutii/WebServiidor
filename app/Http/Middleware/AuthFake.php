<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthFake
{
    public function handle(Request $request, Closure $next)
    {
        // aqui use a MESMA chave de sessão que você colocou no AuthController
        if (!session()->has('usuario_logado')) {
            return redirect()
                ->route('login')
                ->with('erro', 'Você precisa estar logado para acessar essa página.');
        }

        return $next($request);
    }
}
