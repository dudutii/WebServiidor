<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $noticia->titulo }} – Projeto Max</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero-img {
            width: 100%;
            max-height: 420px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Projeto Max</a>

        <div>
            <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm me-2">
                Voltar para Home
            </a>
            <a href="{{ route('home') }}" class="btn btn-secondary mt-3">
                Voltar para a página inicial
            </a>
            </a>
        </div>
    </div>
</nav>

<div class="container mb-5">

    @if (session('sucesso'))
        <div class="alert alert-success">
            {{ session('sucesso') }}
        </div>
    @endif

    {{-- Título + data --}}
    <h1 class="mb-2">{{ $noticia->titulo }}</h1>

    <p class="text-muted">
        @if ($noticia->data_publicacao)
            {{ \Carbon\Carbon::parse($noticia->data_publicacao)->translatedFormat('d \d\e F \d\e Y') }}
        @else
            Publicada em {{ $noticia->created_at->format('d/m/Y H:i') }}
        @endif
    </p>

    {{-- Imagem principal --}}
    @if ($noticia->imagem)
        <div class="mb-4">
            <img src="{{ $noticia->imagem }}" alt="Imagem da notícia" class="hero-img rounded shadow-sm">
        </div>
    @endif

    {{-- Resumo (opcional) --}}
    @if ($noticia->resumo)
        <p class="lead">
            {{ $noticia->resumo }}
        </p>
        <hr>
    @endif

    {{-- Conteúdo completo (permite quebras de linha) --}}
    <div class="bg-white p-4 rounded shadow-sm">
        {!! nl2br(e($noticia->conteudo)) !!}
    </div>

</div>

</body>
</html>
