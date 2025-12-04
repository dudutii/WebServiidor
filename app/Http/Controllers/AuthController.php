<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  
    public function showLogin()
    {
        return view('login');
    }

    
    public function login(Request $request)
    {
        // Validação básica
        $dados = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Procura o usuário na TABELA users
        $user = User::where('email', $dados['email'])->first();

        // Se não achou ou a senha não confere -> erro
        if (! $user || ! Hash::check($dados['password'], $user->password)) {
            return back()
                ->withInput(['email' => $dados['email']])
                ->with('erro', 'E-mail ou senha inválidos.');
        }

        // Guarda dados mínimos na sessão (usado pelo middleware AuthFake)
        session(['usuario' => [
            'id'    => $user->id,
            'nome'  => $user->name,
            'email' => $user->email,
        ]]);

        // Redireciona para a tela protegida (editar home)
        return redirect()->route('home.edit');
    }

    //logout 
    public function logout(Request $request)
    {
        // Remove dados da sessão
        $request->session()->forget('usuario');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
