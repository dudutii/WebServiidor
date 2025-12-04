<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista de Usuários</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .page-header {
      background-color: #1A3561;
      color: #fff;
      padding: 1rem 0;
      text-align: center;
      margin-bottom: 2rem;
    }
    .table th {
      background-color: #0D2240;
      color: #fff;
    }
    .btn-primary {
      background-color: #1A3561;
      border-color: #1A3561;
    }
    .btn-primary:hover {
      background-color: #0D2240;
    }
  </style>
</head>
<body>

  <div class="page-header">
    <h2>Lista de Usuários</h2>
  </div>

  <div class="container">
    <?php if (!empty($usuarios)): ?>
      <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover align-middle text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios as $u): ?>
              <tr>
                <td><?= htmlspecialchars($u["id"]) ?></td>
                <td><?= htmlspecialchars($u["nome"]) ?></td>
                <td><?= htmlspecialchars($u["email"]) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <div class="alert alert-warning text-center" role="alert">
        Nenhum usuário encontrado.
      </div>
    <?php endif; ?>

    <div class="text-center mt-4">
      <a href="/usuario_form" class="btn btn-primary">
        ➕ Cadastrar novo usuário
      </a>
    </div>

    <div class="text-center mt-4">
      <a href="/" class="btn btn-primary">
         HOME
      </a>
    </div>
  </div>

  <footer class="bg-dark text-white text-center py-3 mt-5">
    &copy; 2025 Projeto Max · UTFPR
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
