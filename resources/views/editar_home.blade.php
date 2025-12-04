<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Home – Projeto Max</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Editar página inicial</h3>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">Ver Home</a>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Criar Usuário</a>
  </div>

  @if (session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif

  <form method="post" action="{{ route('home.update') }}" enctype="multipart/form-data" class="card p-4">
    @csrf

    {{-- Banner --}}
    <h5>Banner</h5>
    <div class="mb-3">
      <label class="form-label">Legenda</label>
      <input type="text" name="banner_legenda" class="form-control"
             value="{{ old('banner_legenda', $texto->banner_legenda) }}">
    </div>

    <div class="mb-3">
      <label class="form-label">Título</label>
      <input type="text" name="banner_titulo" class="form-control"
             value="{{ old('banner_titulo', $texto->banner_titulo) }}">
    </div>

    <div class="mb-3">
      <label class="form-label">Imagem do banner</label>
      <input type="file" name="banner_imagem" class="form-control" accept="image/*">
      <small class="text-muted d-block mt-1">
          Atual: {{ $texto->banner_imagem }}
      </small>
    </div>

    <div class="mb-4">
      <label class="form-label">Conteúdo da página</label>
      <textarea name="conteudo" rows="4" class="form-control">{{ old('conteudo', $texto->conteudo) }}</textarea>
    </div>

    <hr>

    {{-- Notícias em destaque --}}
    <h5 class="mb-3">Últimas notícias (3 cards da Home)</h5>

    @if ($noticias->isEmpty())
        <p class="text-muted">
            Nenhuma notícia cadastrada. Crie notícias em <strong>/noticias</strong> e depois volte aqui para escolher as que aparecem na home.
        </p>
    @else
        <div class="row g-3">
            @foreach ($noticias as $noticia)
                <div class="col-md-4">
                    <div class="border rounded p-3 bg-white h-100">
                        <p class="fw-bold mb-2">Notícia {{ $loop->iteration }}</p>

                        <input type="hidden" name="noticia[{{ $noticia->id }}][id]" value="{{ $noticia->id }}">

                        <div class="mb-2">
                            <label class="form-label small mb-1">Título</label>
                            <input type="text" class="form-control form-control-sm"
                                   name="noticia[{{ $noticia->id }}][titulo]"
                                   value="{{ old("noticia.{$noticia->id}.titulo", $noticia->titulo) }}">
                        </div>

                        <div class="mb-2">
                            <label class="form-label small mb-1">Resumo</label>
                            <textarea class="form-control form-control-sm" rows="3"
                                      name="noticia[{{ $noticia->id }}][resumo]">{{ old("noticia.{$noticia->id}.resumo", $noticia->resumo) }}</textarea>
                        </div>

                        <div class="mb-2">
                            <label class="form-label small mb-1">Data</label>
                            <input type="date" class="form-control form-control-sm"
                                   name="noticia[{{ $noticia->id }}][data]"
                                   value="{{ old("noticia.{$noticia->id}.data", $noticia->data_publicacao) }}">
                        </div>

                        <div class="mb-2">
                            <label class="form-label small mb-1">Imagem</label>
                            <input type="file" class="form-control form-control-sm"
                                   name="noticia[{{ $noticia->id }}][imagem]">
                            @if ($noticia->imagem)
                                <small class="text-muted d-block mt-1">
                                    Atual: <a href="{{ $noticia->imagem }}" target="_blank">Ver imagem</a>
                                </small>
                            @endif
                        </div>

                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input"
                                   name="noticia[{{ $noticia->id }}][destaque]"
                                   {{ $noticia->destaque_home ? 'checked' : '' }}>
                            <label class="form-check-label">Destacar na Home</label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-4">
      <button class="btn btn-primary">Salvar alterações</button>
    </div>
  </form>
</div>




</body>
</html>
