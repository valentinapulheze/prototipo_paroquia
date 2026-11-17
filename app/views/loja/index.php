
<?php
$produtos = $produtos ?? [];
?>

<style>
    .loja-container {
        background: #f5f6f8;
        padding: 35px 20px;
        min-height: 75vh;
    }

    .loja-titulo {
        color: #003B61;
        font-weight: 700;
        text-align: center;
        margin-bottom: 8px;
    }

    .loja-subtitulo {
        color: #777;
        text-align: center;
        margin-bottom: 35px;
    }

    .produto-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,.08);
        height: 100%;
        transition: .2s;
    }

    .produto-card:hover {
        transform: translateY(-5px);
    }

    .produto-link {
        display: block;
        height: 100%;
        text-decoration: none;
        color: inherit;
    }

    .produto-imagem {
        width: 100%;
        height: 230px;
        object-fit: cover;
        background: #eee;
    }

    .produto-info {
        padding: 18px;
    }

    .produto-nome {
        color: #003B61;
        font-weight: 700;
        font-size: 18px;
    }

    .produto-preco {
        color: #C8A961;
        font-size: 21px;
        font-weight: 700;
    }

    .loja-vazia {
        text-align: center;
        color: #777;
        padding: 50px 15px;
    }
</style>

<div class="loja-container">
    <div class="container">

        <h2 class="loja-titulo">Nossa Loja</h2>

        <p class="loja-subtitulo">
            Confira os produtos disponíveis em nossa lojinha.
        </p>

        <?php if (!empty($produtos)): ?>

            <div class="row g-4">

                <?php foreach ($produtos as $produto): ?>

                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                        <div class="produto-card">

                            <a
                                href="<?= BASE_URL ?>/?url=detalheProduto&id=<?= (int)$produto['id_loja'] ?>"
                                class="produto-link"
                            >

                                <?php if (!empty($produto['foto'])): ?>

                                    <img
                                        src="<?= BASE_URL ?>/<?= htmlspecialchars(ltrim($produto['foto'], '/'), ENT_QUOTES, 'UTF-8') ?>"
                                        class="produto-imagem"
                                        alt="<?= htmlspecialchars($produto['titulo'], ENT_QUOTES, 'UTF-8') ?>"
                                    >

                                <?php else: ?>

                                    <div class="produto-imagem d-flex align-items-center justify-content-center">
                                        <i class="fa fa-image fa-3x text-secondary"></i>
                                    </div>

                                <?php endif; ?>

                                <div class="produto-info">

                                    <h5 class="produto-nome">
                                        <?= htmlspecialchars($produto['titulo'], ENT_QUOTES, 'UTF-8') ?>
                                    </h5>

                                    <p class="produto-preco mb-0">
                                        R$ <?= number_format((float)$produto['preco'], 2, ',', '.') ?>
                                    </p>

                                    <small class="text-muted">
                                        Ver detalhes
                                    </small>

                                </div>

                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="loja-vazia">
                <i class="fa fa-shopping-bag fa-3x mb-3"></i>

                <h4>Nenhum produto disponível</h4>

                <p>Em breve teremos novidades em nossa loja!</p>
            </div>

        <?php endif; ?>

    </div>
</div>
