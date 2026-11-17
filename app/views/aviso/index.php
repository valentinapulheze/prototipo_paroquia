
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Gerenciar Avisos</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <style>

        body {
            background: #f5f6f8;
            font-family: Arial, sans-serif;
        }

        .container-admin {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px 80px;
        }

        .titulo {
            color: #003B61;
            font-weight: 700;
        }

        .btn-paroquia {
            background: #C8A961;
            border: none;
            color: white;
        }

        .btn-paroquia:hover {
            background: #b49752;
            color: white;
        }

        .card-admin {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,.08);
            padding: 25px;
        }

        .table thead {
            background: #003B61;
            color: white;
        }

        .badge-ativo {
            background: #198754;
        }

        .badge-inativo {
            background: #dc3545;
        }

        .aviso-imagem {
            width: 70px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #C8A961;
        }

    </style>

</head>

<body>

<div class="container-admin">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="titulo">Gerenciar Avisos</h1>

            <p class="text-muted">
                Cadastre, edite e exclua os avisos da paróquia.
            </p>
        </div>

        <a
            href="<?= BASE_URL ?>/?url=novoAviso"
            class="btn"
            style="background-color: #003B61; color: white;">

            + Novo aviso

        </a>

    </div>

    <?php if (!empty($_SESSION['sucesso'])): ?>

        <div class="alert alert-success">

            <?= htmlspecialchars($_SESSION['sucesso']) ?>

        </div>

        <?php unset($_SESSION['sucesso']); ?>

    <?php endif; ?>

    <?php if (!empty($_SESSION['erro'])): ?>

        <div class="alert alert-danger">

            <?= htmlspecialchars($_SESSION['erro']) ?>

        </div>

        <?php unset($_SESSION['erro']); ?>

    <?php endif; ?>

    <div class="card-admin">

        <?php if (empty($avisos)): ?>

            <div class="alert alert-info">

                Nenhum aviso cadastrado.

            </div>

        <?php else: ?>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Foto</th>
                            <th>Título</th>
                            <th>Detalhamento</th>
                            <th>Data</th>
                            <th>Status</th>
                            <th>Ações</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php foreach ($avisos as $aviso): ?>

                        <tr>

                            <td>
                                <?= (int)$aviso['id_aviso'] ?>
                            </td>

                            <td>

                                <?php if (!empty($aviso['foto'])): ?>

                                    <img
                                        src="<?= BASE_URL ?>/<?= htmlspecialchars(ltrim($aviso['foto'], '/'), ENT_QUOTES, 'UTF-8') ?>"
                                        alt="Foto do aviso"
                                        class="aviso-imagem">

                                <?php else: ?>

                                    <span class="text-muted">Sem foto</span>

                                <?php endif; ?>

                            </td>

                            <td>
                                <strong>
                                    <?= htmlspecialchars($aviso['titulo']) ?>
                                </strong>
                            </td>

                            <td>
                                <?= htmlspecialchars($aviso['detalhamento']) ?>
                            </td>

                            <td>

                                <?php if (!empty($aviso['data_expiracao'])): ?>

                                    <?= date(
                                        'd/m/Y',
                                        strtotime($aviso['data_expiracao'])
                                    ) ?>

                                <?php else: ?>

                                    -

                                <?php endif; ?>

                            </td>

                            <td>

                                <?php if (($aviso['status'] ?? 'ativo') === 'ativo'): ?>

                                    <span class="badge badge-ativo">
                                        Ativo
                                    </span>

                                <?php else: ?>

                                    <span class="badge badge-inativo">
                                        Inativo
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <a
                                    href="<?= BASE_URL ?>/?url=editAviso&id=<?= (int)$aviso['id_aviso'] ?>"
                                    class="btn btn-sm btn-primary">

                                    <i class="bi bi-pencil-square"></i>
                                    Editar

                                </a>

                                <form
                                    action="<?= BASE_URL ?>/?url=deleteAviso"
                                    method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este aviso?');">

                                    <input
                                        type="hidden"
                                        name="id_aviso"
                                        value="<?= (int)$aviso['id_aviso'] ?>">

                                    <button type="submit" class="btn btn-sm btn-danger">

                                        <i class="bi bi-trash"></i>
                                        Excluir

                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>

    </div>

</div>

</body>

</html>
