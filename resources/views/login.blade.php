<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Projeto Max</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5" style="max-width: 480px;">
    <h1 class="h3 mb-4 text-center">Login</h1>

    
    @if (session('erro'))
        <div class="alert alert-danger">
            @switch(session('erro'))
                @case('campos')
                    Preencha e-mail e senha.
                    @break
                @case('credenciais')
                    E-mail ou senha inválidos.
                    @break
                @case('proibido')
                    Faça login para acessar.
                    @break
                @default
                    Ocorreu um erro.
            @endswitch
        </div>
    @endif

    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/login') }}" method="POST" class="card p-4 shadow-sm">
    @csrf

    <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="email"
               name="email"
               class="form-control"
               value="{{ old('email') }}"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Senha</label>
        <input type="password"
               name="senha"
               class="form-control"
               required>
    </div>

    
    <button type="submit" class="btn btn-primary w-100 mt-2">
        Entrar
    </button>
</form>
