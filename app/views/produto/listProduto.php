
<?php require_once dirname(__DIR__, 2) . '/core/auth.php'; ?>

<style>
    .loja-page {
        background: #f5f6f8;
        min-height: 80vh;
        padding: 35px 0;
    }

    .loja-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .loja-card .card-header {
        background: #003B61;
        color: white;
        border-bottom: 4px solid #C8A961;
        padding: 20px;
    }

    .btn-loja {
        background: #003B61;
        color: white;
        border: 1px solid #003B61;
    }

    .btn-loja:hover {
        background: #002c49;
        color: white;
    }

    .btn-dourado {
        background: #C8A961;
        color: #003B61;
        border: 1px solid #C8A961;
    }

    .produto-imagem {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 9px;
        border: 2px solid #C8A961;
    }

    .table thead th {
        background: #003B61;
        color: white;
        vertical-align: middle;
    }

    .table tbody td {
        vertical-align: middle;
    }
</style>

<main class="loja-page">
    <div class="container">

        <div class="card shadow loja-card">

            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h2 class="mb-0">Painel da Lojinha</h2>

                <a
                    href="<?= BASE_URL ?>/?url=saveProduto"
                    class="btn btn-dourado"
                >
                    <i class="fa fa-plus"></i> Novo produto
                </a>
            </div>

            <div class="card-body">

                <?php if (empty($produtos)): ?>

                    <div class="text-center py-5">
                        <h5 style="color:#003B61;">Nenhum produto cadastrado.</h5>
                        <p class="text-muted">
                            Clique em "Novo produto" para adicionar o primeiro.
                        </p>
                    </div>

                <?php else: ?>

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover align-middle">

                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Imagem</th>
                                    <th>Produto</th>
                                    <th class="text-center">Preço</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($produtos as $produto): ?>

                                    <tr>

                                        <td class="text-center">
                                            <?= (int)$produto['id_loja'] ?>
                                        </td>

                                        <td class="text-center">
                                            <?php if (!empty($produto['foto'])): ?>
                                                <img
                                                    src="<?= BASE_URL ?>/<?= htmlspecialchars(ltrim($produto['foto'], '/'), ENT_QUOTES, 'UTF-8') ?>"
                                                    alt="<?= htmlspecialchars($produto['titulo'], ENT_QUOTES, 'UTF-8') ?>"
                                                    class="produto-imagem"
                                                >
                                            <?php else: ?>
                                                <span class="text-muted">Sem imagem</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($produto['titulo'], ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td class="text-center">
                                            R$ <?= number_format((float)$produto['preco'], 2, ',', '.') ?>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">

                                                <a
                                                    href="<?= BASE_URL ?>/?url=editProduto&id=<?= (int)$produto['id_loja'] ?>"
                                                    class="btn btn-sm btn-warning"
                                                    title="Editar"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <form
                                                    action="<?= BASE_URL ?>/?url=deleteProduto"
                                                    method="POST"
                                                    onsubmit="return confirm('Tem certeza que deseja excluir este produto?');"
                                                >
                                                    <input
                                                        type="hidden"
                                                        name="id_loja"
                                                        value="<?= (int)$produto['id_loja'] ?>"
                                                    >

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm btn-danger"
                                                        title="Excluir"
                                                    >
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                <?php endif; ?>

            </div>
        </div>

    </div>
</main>
