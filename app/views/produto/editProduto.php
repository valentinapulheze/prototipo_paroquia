
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

    .help-button {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px solid #C8A961;
        background: #C8A961;
        color: #003B61;
        font-weight: bold;
    }

    .form-label {
        color: #003B61;
        font-weight: 600;
    }

    .produto-atual {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid #C8A961;
    }
</style>

<main class="loja-page">
    <div class="container">

        <div class="card shadow loja-card">
            <div class="card-header text-center position-relative">
                <h2 class="mb-0">Editar Produto</h2>

                <button
                    type="button"
                    class="help-button position-absolute top-50 end-0 translate-middle-y me-3"
                    data-bs-toggle="modal"
                    data-bs-target="#helpModal"
                >?</button>
            </div>

            <div class="card-body p-4">

                <form
                    action="<?= BASE_URL ?>/?url=editProduto"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    <input
                        type="hidden"
                        name="id_loja"
                        value="<?= (int)$produto['id_loja'] ?>"
                    >

                    <div class="row">

                        <div class="col-md-8 mb-3">
                            <label class="form-label">Nome do produto</label>
                            <input
                                type="text"
                                class="form-control"
                                name="titulo"
                                maxlength="45"
                                value="<?= htmlspecialchars($produto['titulo'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                required
                            >
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Preço (R$)</label>
                            <input
                                type="number"
                                class="form-control"
                                name="preco"
                                step="0.01"
                                min="0"
                                value="<?= htmlspecialchars($produto['preco'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                required
                            >
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Imagem atual</label>

                            <div class="mb-3">
                                <?php if (!empty($produto['foto'])): ?>
                                    <img
                                        src="<?= BASE_URL ?>/<?= htmlspecialchars(ltrim($produto['foto'], '/'), ENT_QUOTES, 'UTF-8') ?>"
                                        alt="<?= htmlspecialchars($produto['titulo'], ENT_QUOTES, 'UTF-8') ?>"
                                        class="produto-atual"
                                    >
                                <?php else: ?>
                                    <p class="text-muted">Nenhuma imagem cadastrada.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="form-label">Alterar imagem</label>

                            <input
                                type="file"
                                class="form-control"
                                name="foto"
                                accept=".jpg,.jpeg,.png,.gif,.webp"
                            >

                            <small class="text-muted">
                                Deixe vazio caso queira manter a imagem atual.
                            </small>
                        </div>

                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-loja">
                            <i class="fa fa-save"></i> Salvar alterações
                        </button>

                        <a
                            href="<?= BASE_URL ?>/?url=listProduto"
                            class="btn btn-outline-secondary"
                        >
                            Voltar
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</main>

<!-- Modal de ajuda -->
<div class="modal fade" id="helpModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" style="color:#003B61;">
                    Ajuda para editar produto
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>
            </div>

            <div class="modal-body text-center">
                <img
                    src="<?= BASE_URL ?>/img/help_editar_produto.png"
                    class="img-fluid"
                    alt="Ajuda para editar produto"
                >
            </div>

        </div>
    </div>
</div>
