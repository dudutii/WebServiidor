<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $noticia['titulo'] }} – Projeto Max</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Projeto Max</a>
        <div class="ms-auto">
            @if ($logado)
                <a href="{{ route('home.edit') }}" class="btn btn-sm btn-outline-light me-2">Editar Home</a>
                <a href="{{ route('logout') }}" class="btn btn-sm btn-light">Sair</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Área restrita</a>
            @endif
        </div>
    </div>
</nav>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            @if (!empty($noticia['imagem']))
                <img src="{{ $noticia['imagem'] }}" class="img-fluid rounded mb-3" alt="Imagem da notícia">
            @endif

            <small class="text-muted d-block mb-2">
                {{ $noticia['data'] ?? '' }}
            </small>

            <h1 class="h3 fw-bold mb-3">
                {{ $noticia['titulo'] }}
            </h1>

            <p class="fs-6">
                {{ $noticia['texto'] }}
            </p>

            <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-3">
                ← Voltar para a página inicial
            </a>

        </div>
    </div>
</div>

</body>
</html>
