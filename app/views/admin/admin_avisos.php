<?php
require_once 'conexao.php';

// Verificar se está em modo de edição
$avisoEdicao = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM avisos WHERE id = ?");
    $stmt->execute([$id]);
    $avisoEdicao = $stmt->fetch();
}

// Buscar todos os avisos cadastrados
$stmt = $pdo->query("SELECT * FROM avisos ORDER BY id DESC");
$avisos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Administrador - Avisos Paroquiais</title>

  <!-- Bootstrap 5 & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --primary-blue: #003B61;
      --primary-hover: #002842;
    }

    .admin-title {
      color: var(--primary-blue);
      font-weight: 700;
    }

    .admin-card {
      background-color: #ffffff;
      border-radius: 16px;
      padding: 1.8rem;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .btn-custom {
      background-color: var(--primary-blue);
      color: #ffffff;
      font-weight: 600;
    }

    .btn-custom:hover {
      background-color: var(--primary-hover);
      color: #ffffff;
    }

    .img-preview {
      width: 60px;
      height: 40px;
      object-fit: cover;
      border-radius: 6px;
    }
  </style>
</head>
<body class="bg-light pb-5">

<main class="container-fluid px-4 pt-4">

  <div class="mb-4">
    <h1 class="admin-title m-0">Administração de Avisos Paroquiais</h1>
    <p class="text-muted">Gerencie os avisos que aparecem para a comunidade.</p>
  </div>

  <div class="row g-4">

    <!-- COLUNA 1: Formulário (Criar / Editar) -->
    <div class="col-12 col-lg-4">
      <div class="admin-card">
        <h4 class="fw-bold mb-3" style="color: var(--primary-blue);">
          <i class="bi bi-<?= $avisoEdicao ? 'pencil-square' : 'plus-circle' ?> me-1"></i>
          <?= $avisoEdicao ? 'Editar Aviso' : 'Novo Aviso' ?>
        </h4>

        <form action="salvar_aviso.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $avisoEdicao['id'] ?? '' ?>">
          <input type="hidden" name="imagem_atual" value="<?= $avisoEdicao['imagem'] ?? '' ?>">

          <div class="mb-3">
            <label for="titulo" class="form-label fw-bold">Título do Aviso</label>
            <input type="text" class="form-control" id="titulo" name="titulo" 
                   value="<?= htmlspecialchars($avisoEdicao['titulo'] ?? '') ?>" placeholder="Ex: Semana da Família" required>
          </div>

          <div class="mb-3">
            <label for="data_info" class="form-label fw-bold">Data / Período / Horário</label>
            <input type="text" class="form-control" id="data_info" name="data_info" 
                   value="<?= htmlspecialchars($avisoEdicao['data_info'] ?? '') ?>" placeholder="Ex: 02 a 08 de Agosto • 19h" required>
          </div>

          <div class="mb-3">
            <label for="imagem_arquivo" class="form-label fw-bold">Imagem do Aviso</label>
            <input type="file" class="form-control" id="imagem_arquivo" name="imagem_arquivo" accept="image/*" <?= $avisoEdicao ? '' : 'required' ?>>
            <?php if (!empty($avisoEdicao['imagem'])): ?>
              <small class="text-muted d-block mt-1">Imagem atual: <?= htmlspecialchars($avisoEdicao['imagem']) ?></small>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="descricao" class="form-label fw-bold">Descrição Curta</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3" 
                      placeholder="Descrição do aviso..." required><?= htmlspecialchars($avisoEdicao['descricao'] ?? '') ?></textarea>
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-custom py-2">
              <i class="bi bi-check-lg me-1"></i> <?= $avisoEdicao ? 'Atualizar Aviso' : 'Salvar Aviso' ?>
            </button>
            <?php if ($avisoEdicao): ?>
              <a href="admin_avisos.php" class="btn btn-outline-secondary">Cancelar Edição</a>
            <?php endif; ?>
          </div>
        </form>
      </div>
    </div>

    <!-- COLUNA 2: Listagem e Ações -->
    <div class="col-12 col-lg-8">
      <div class="admin-card">
        <h4 class="fw-bold mb-3" style="color: var(--primary-blue);">
          <i class="bi bi-list-stars me-1"></i> Avisos Cadastrados
        </h4>

        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>Imagem</th>
                <th>Título</th>
                <th>Data / Horário</th>
                <th class="text-end">Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($avisos)): ?>
                <tr>
                  <td colspan="4" class="text-center text-muted py-4">Nenhum aviso cadastrado no momento.</td>
                </tr>
              <?php else: ?>
                <?php foreach ($avisos as $aviso): ?>
                  <tr>
                    <td>
                      <img src="<?= htmlspecialchars($aviso['imagem']) ?>" class="img-preview" alt="Imagem" onerror="this.src='https://via.placeholder.com/60x40'">
                    </td>
                    <td><strong style="color: var(--primary-blue);"><?= htmlspecialchars($aviso['titulo']) ?></strong></td>
                    <td><small class="text-muted"><?= htmlspecialchars($aviso['data_info']) ?></small></td>
                    <td class="text-end">
                      <a href="admin_avisos.php?action=edit&id=<?= $aviso['id'] ?>" class="btn btn-sm btn-outline-primary me-1" title="Editar">
                        <i class="bi bi-pencil"></i>
                      </a>
                      <a href="excluir_aviso.php?id=<?= $aviso['id'] ?>" class="btn btn-sm btn-outline-danger" 
                         onclick="return confirm('Tem certeza que deseja excluir este aviso?');" title="Excluir">
                        <i class="bi bi-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>

</main>

</body>
</html>