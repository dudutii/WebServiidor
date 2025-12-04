{{-- resources/views/home.blade.php --}}
@php
    use Illuminate\Support\Str;

    // Garante que existe um objeto $texto (mesmo se vier null)
    $texto = $texto ?? null;

    // Valores padrão do banner
    $bannerImagem  = optional($texto)->banner_imagem ?? '/imagens/hero.jpg';
    $bannerTitulo  = optional($texto)->banner_titulo  ?? 'Bem-vindo';
    $bannerLegenda = optional($texto)->banner_legenda ?? 'UTFPR · USP · UofT · IEEE';

    // Garante que $noticiasDestacadas exista como coleção
    $noticiasDestacadas = $noticiasDestacadas ?? collect();

    // primeira notícia em destaque (para usar no banner, se existir)
    $primeiraNoticia = $noticiasDestacadas->first();
@endphp

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Projeto Max – Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        .max-header {
            background-color: #1A3561;
            border-bottom: 4px solid #ffcc00;
            color: white;
        }
        .max-nav { background-color: #0D2240; }

        .max-nav a {
            color: #b8d4ff;
            text-transform: uppercase;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.75rem 1rem;
            text-decoration: none;
            border-right: 1px solid rgba(255,255,255,0.1);
        }
        .max-nav a:last-child { border-right: none; }
        .max-nav a:hover { color: #fff; background: rgba(255,255,255,0.1); }

        .hero img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            display: block;
        }
        .hero-box {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            background: #ffffff;
            padding: 1rem 1.25rem;
            max-width: 600px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        .hero-tag {
            background: #17345f;
            color: white;
            padding: 0.3rem 0.75rem;
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 0.35rem;
        }

        .news-section {
            background: #f8f9fa;
            padding: 3rem 0;
        }
        .news-card {
            border: none;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .news-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <!-- Cabeçalho -->
    <header class="max-header py-3">
        <div class="container d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center">
                <img src="/imagens/logo3.png" alt="Logo" height="100">
                <div class="ms-3">
                    <h5 class="m-0 fw-bold text-white">UTFPR · USP · UofT · IEEE</h5>
                    <small>Engenharia e Computação</small>
                </div>
            </div>

            <div>
                @if ($logado ?? false)
                    <span class="text-white small me-2">
                        Olá, {{ session('user_nome') }}
                    </span>
                    <a href="{{ route('logout') }}" class="btn btn-sm btn-light">
                        Sair
                    </a>
                @else
                    {{-- login mais "escondido" --}}
                    <a href="{{ route('login') }}" class="text-white-50 small text-decoration-none">
                        Área restrita
                    </a>
                @endif
            </div>
        </div>
    </header>

    <!-- Navegação -->
    <nav class="max-nav">
        <div class="container d-flex justify-content-center">
            <a href="/livros">Livros</a>
            <a href="https://buscatextual.cnpq.br/buscatextual/visualizacv.do" target="_blank">Lattes</a>

            @if ($logado ?? false)
                <a href="{{ route('home.edit') }}" class="text-warning">
                    Editar Home
                </a>
            @endif
        </div>
    </nav>

    <!-- Banner -->
    <section class="hero position-relative">
        @if ($primeiraNoticia)
            {{-- Banner leva para a primeira notícia em destaque --}}
            <a href="{{ route('noticias.show', $primeiraNoticia->slug) }}">
                <img src="{{ $bannerImagem }}" alt="Banner principal">
            </a>
        @else
            <img src="{{ $bannerImagem }}" alt="Banner principal">
        @endif

        <div class="hero-box">
            <div class="hero-tag">{{ $bannerLegenda }}</div>
            <h3 class="mb-0">{{ $bannerTitulo }}</h3>
        </div>
    </section>

    <!-- Notícias em destaque -->
    <section class="news-section">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Últimas notícias</h4>
                <small class="text-muted">
                    Notícias em destaque ou, se não houver, as 3 mais recentes.
                </small>
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @forelse ($noticiasDestacadas as $noticia)
                    <div class="col">
                        {{-- TODO principal: link para a página da notícia --}}
                        <a href="{{ route('noticias.show', $noticia->slug) }}"
                           class="text-decoration-none text-dark">
                            <div class="card news-card h-100">

                                @if ($noticia->imagem)
                                    <img src="{{ $noticia->imagem }}"
                                         alt="{{ $noticia->titulo }}">
                                @endif

                                <div class="card-body">
                                    <small class="text-muted d-block mb-1">
                                        @if ($noticia->data_publicacao)
                                            {{ \Carbon\Carbon::parse($noticia->data_publicacao)->translatedFormat('d \\d\\e F \\d\\e Y') }}
                                        @elseif ($noticia->created_at)
                                            {{ $noticia->created_at->format('d/m/Y') }}
                                        @endif
                                    </small>

                                    <h5 class="fw-semibold mb-2">
                                        {{ $noticia->titulo }}
                                    </h5>

                                    <p class="text-muted small mb-0">
                                        {{ Str::limit($noticia->resumo ?? '', 120) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-muted">
                        Nenhuma notícia em destaque selecionada.
                        @if ($logado ?? false)
                            Vá em <strong>Editar Home</strong> e marque notícias para aparecerem aqui.
                        @endif
                    </p>
                @endforelse
            </div>

        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        &copy; 2025 Projeto Max · UTFPR
    </footer>

</body>
</html>
