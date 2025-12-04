<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar novo usuário - Projeto Max</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

{{-- ALERTA: só deve chegar aqui quem está logado (rota tem middleware auth) --}}
<div class="container mt-3">
    @if (session('erro'))
        <div class="alert alert-danger">
            {{ session('erro') }}
        </div>
    @endif

    @if (session('sucesso'))
        <div class="alert alert-success">
            {{ session('sucesso') }}
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
</div>

{{-- Cabeçalho igual ao restante do site --}}
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#1A3561;">
    <div class="container-fluid d-flex justify-content-center">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="/imagens/logo3.png" alt="Logo" width="200" height="200">
        </a>
    </div>
</nav>

{{-- Menu superior --}}
<div class="w-100" style="background-color:#0D2240;">
    <div class="container d-flex justify-content-around py-2">
        <a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a>
        <a href="/usuarios" class="text-white text-decoration-none">Usuários</a>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h2 class="text-center mb-4">Criar novo usuário</h2>

                {{-- Formulário de cadastro de usuário --}}
                <form method="post" action="{{ route('usuarios.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               required>
                    </div>

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
                               name="password"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirmar senha</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Salvar usuário
                    </button>
                </form>

                <div class="mt-3 text-center">
                    <a href="{{ route('home') }}" class="small text-decoration-none">
                        &larr; Voltar para a Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3">
    &copy; 2025 Max.
</footer>

</body>
</html>
