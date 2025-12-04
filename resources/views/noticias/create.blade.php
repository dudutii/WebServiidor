<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar notícia – Projeto Max</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between mb-4">
        <h3>Nova notícia</h3>
        <a href="{{ route('home.edit') }}" class="btn btn-outline-secondary btn-sm">
            Voltar para editar Home
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('noticias.store') }}"
          enctype="multipart/form-data" class="card p-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control"
                   value="{{ old('titulo') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Data de publicação</label>
            <input type="date" name="data_publicacao" class="form-control"
                   value="{{ old('data_publicacao') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Resumo (aparece no card)</label>
            <textarea name="resumo" rows="3" class="form-control">{{ old('resumo') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Conteúdo completo</label>
            <textarea name="conteudo" rows="6" class="form-control">{{ old('conteudo') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagem</label>
            <input type="file" name="imagem" class="form-control" accept="image/*">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="destaque_home"
                   id="destaque_home" value="1"
                {{ old('destaque_home') ? 'checked' : '' }}>
            <label class="form-check-label" for="destaque_home">
                Mostrar essa notícia na Home (nos 3 cards)
            </label>
        </div>

        <button class="btn btn-primary">Salvar notícia</button>
    </form>
</div>
</body>
</html>
