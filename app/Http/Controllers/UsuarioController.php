<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Lista todos os usuários (para a tela usuario_list.blade.php).
     */
    public function index()
    {
        $usuarios = User::all();

        return view('usuario_list', compact('usuarios'));
    }

    /**
     * Formulário para criar novo usuário.
     */
    public function create()
    {
        return view('usuario_form');
    }

    /**
     * Salva um novo usuário no banco.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed', // precisa do password_confirmation
        ]);

        // Criptografa a senha
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()
            ->route('usuarios.index')
            ->with('sucesso', 'Usuário criado!');
    }
}
