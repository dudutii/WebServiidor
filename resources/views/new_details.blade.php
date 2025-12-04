<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($noticia['titulo']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .header {
      background-color: #1A3561;
      color: #fff;
      padding: 1.5rem 0;
      text-align: center;
      margin-bottom: 2rem;
    }
  </style>
</head>
<body>

  <div class="header">
    <h2><?= htmlspecialchars($noticia['titulo']) ?></h2>
    <small><?= htmlspecialchars($noticia['data']) ?></small>
  </div>

  <div class="container mb-5">
    <img src="<?= htmlspecialchars($noticia['imagem']) ?>" class="img-fluid rounded mb-4" alt="Imagem da notícia">
    <p style="text-align: justify;"><?= nl2br(htmlspecialchars($noticia['conteudo'])) ?></p>

    <a href="/" class="btn btn-primary mt-3">← Voltar</a>
  </div>

  <footer class="bg-dark text-white text-center py-3 mt-5">
    &copy; 2025 Projeto Max · UTFPR
  </footer>

</body>
</html>
